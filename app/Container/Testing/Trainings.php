<?php

namespace App\Container\Testing;


use App\Models\AnswerUsers;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Task;
use App\Models\Testing;
use App\Models\Training;
use App\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Query\JoinClause;

abstract class Trainings
{
    /**
     * @var User
     */
    protected $user;
    /**
     * @var Testing|Lesson|Task
     */
    protected $model;

    /**
     * @var string
     */
    protected $classModel;

    /**
     * @var Training;
     */
    protected $training;

    /**
     * @var string
     */
    protected $type = 'text';

    /**
     * @var array Список вопросов с ответами
     */
    protected $question = [];

    /**
     * Trainings constructor.
     * @param User $user
     * @param Testing|Lesson|Task $model
     * @param null $training
     */
    public function __construct(User $user, $model, $training = null)
    {
        $this->user = $user;
        $this->model = $model;
        if (empty($training) && !empty($model)) {
            $this->training = $this->getOrCreateTraining();
        } else {
            $this->training = $training;
        }

    }

    /**
     * Вывести данные по обучению
     *
     * @return Training
     */
    protected function getOrCreateTraining(): Training
    {
        return Training::firstOrCreate([
            'user_id' => $this->user->id,
            'morphtable_type' => $this->classModel,
            'morphtable_id' => $this->model->id,
            'passed' => false,
        ]);
    }

    /**
     * @return Training
     */
    public function getTraining(): Training
    {
        return $this->training;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return MorphMany
     */
    public function getList()
    {
        $testing = $this->model;
        return $testing->questions()
            ->with([AnswerUsers::TABLE => function (HasOne $query) {
                $query->where('user_id', '=', $this->user->id);
                $query->where('training_id', '=', $this->training->id);
            }]);
    }


    /**
     * Записать ответ на вопрос
     *
     * @param $idQuestions
     * @param $answer
     * @return mixed
     */
    public function setAnswer($idQuestions, $answer)
    {
        $result = AnswerUsers::firstOrCreate([
            'question_id' => $idQuestions,
            'user_id' => $this->user->id,
            'training_id' => $this->training->id
        ]);
        
        if ($this->type === Question::QUESTION_MANY_TYPE) {
            $tempAnswer = json_decode($result->answer, true) ?? [];

            if(!in_array($answer,$tempAnswer)){
                $tempAnswer[] = $answer;
            } else {
                $delIndex = array_search($answer, $tempAnswer);
                unset($tempAnswer[$delIndex]);
                sort($tempAnswer);
            }
            $userAnswer = array_unique($tempAnswer);
        } else {
            $userAnswer = [$answer];
        }
        $result->answer = \GuzzleHttp\json_encode($userAnswer);
        $result->save();

        return $result;
    }


    /**
     * Проверка, что все вопросы отвечены
     *
     * @return int|null
     */
    public function checkAllQuestionsAnswered(): ?int
    {
        $result = 0;
        if(!empty($this->model)){
            $raw = $this->model
                ->leftJoin(Question::TABLE, function (JoinClause $join) {
                    $join->on(Question::TABLE . '.morphtable_id', '=', $this->model->getTable() . '.id')
                        ->where(Question::TABLE . '.morphtable_type', '=', $this->classModel)
                        ->whereNull(Question::TABLE . '.deleted_at');
                })
                ->leftJoin(AnswerUsers::TABLE, function (JoinClause $join) {
                    $join->on(AnswerUsers::TABLE . '.question_id', '=', Question::TABLE . '.id')
                        ->where(AnswerUsers::TABLE . '.training_id', '=', $this->training->id)
                        ->where(AnswerUsers::TABLE . '.user_id', '=', $this->user->id);
                })
                ->whereRaw($this->model->getTable() . '.id = ' . $this->model->id);
            if($this->model instanceof Task){
                $raw->whereRaw($this->model->getTable() . '.type = "' . Question::TESTING.'"');
            }
            $raw->groupBy($this->model->getTable() . '.id')
                ->select([
                    \DB::raw('SUM(CASE
                    WHEN `'.AnswerUsers::TABLE.'`.`id` IS NULL THEN 1
                    WHEN `'.AnswerUsers::TABLE.'`.`id` IS NOT NULL THEN 0
                    END) AS countNull'),
                    $this->model->getTable() . '.id'
                ]);
            $result = $raw->first()->countNull ?? 0;
        }

        return $result;
    }


    /**
     * Завершить
     */
    public function complete()
    {
        $this->training->passed = true;
        $this->training->save();
    }
}