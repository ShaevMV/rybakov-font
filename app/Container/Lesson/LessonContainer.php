<?php

namespace App\Container\Lesson;

use App\Container\InterfaceStage;
use App\Models\AnswerUsers;
use App\Models\Direction;
use App\Models\Stage;
use App\Models\Task;
use App\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LessonContainer extends LessonAbstract implements InterfaceStage
{
    protected $isQuestionsAnswered = true;
    /**
     * @var null|Task
     */
    protected $selectTask = null;

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getList()
    {
        return $this->getModel()
            ->orderBy('sort')
            ->with(Task::TABLE)
            ->get();
    }

    /**
     * Проверить, что все вопросы из предыдущих уроков отвечены
     *
     * @return bool
     */
    public function isQuestionsAnswered()
    {
        if($this->isQuestionsAnswered === true && !empty($this->lessonSort)){
            $this->isQuestionsAnswered = LessonTesting::getTaskQuestionsNotAnswered(
                $this->lessonSort,
                $this->directionId,
                $this->user->id) ?? false;
        }
        return $this->isQuestionsAnswered;
    }


    /**
     * Записать/обновить выбранный урок
     *
     * @param int|null $taskId
     * @return bool|\Illuminate\Database\Eloquent\Builder|static
     */
    public function selectTask($taskId = null)
    {
        if(empty($taskId)){
            $this->selectTask = $this->getLastSelectTask()->tasks ?? null;
        } else{
            $this->selectTask = is_object($this->isQuestionsAnswered()) ?
                $this->isQuestionsAnswered() :
                $this->setSelectTask($taskId);
        }
        return $this->selectTask;
    }

    /**
     * Вывести список вопросов в задании урока
     *
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function getQuestionsForTask()
    {
        /** @var Task $task */
        $task = $this->selectTask;
        if($task instanceof Task) {
            $lessonTesting = new LessonTesting(
                $this->user,
                $task);
            $taskQuestionsList = $lessonTesting->getList()->get();
        }

        return $taskQuestionsList ?? [];
    }

    /**
     *
     *
     * @return Stage|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object
     */
    public function getStage()
    {
        return Stage::getStageForLesson($this->directionId);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Завершение обучения
     */
    public function complete()
    {
        if($selectTask = $this->getLastSelectTask())
            $selectTask->delete();
    }

    public function setAnswer(int $questionsId)
    {
        return AnswerUsers::firstOrCreate([
            'question_id' => $questionsId,
            'user_id' => $this->user->id,
            'training_id' => $this->training->id
        ]);
    }

    /**
     * @param Task $task
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getQuestions(Task $task)
    {
        return $task
            ->questions()
            ->with([AnswerUsers::TABLE => function (HasOne $query) {
                $query->where('user_id', '=', $this->user->id);
                $query->where('training_id', '=', $this->training->id);
            }])
            ->get();
    }

    /**
     * Вывести финальное сообщение после прохождения онлайн обучения
     *
     * @return string
     */
    public function getMessage(): string
    {
        $directRus = Direction::DIRECTION_LIST_RUS[$this->directionId];
        return "<span class='uk-text-bold'>Поздравляем!</span> Вы завершили онлайн-курс по работе с инструментом оценки качества дошкольного образования $directRus. Сертификат о прохождении курса уже в Вашем личном кабинете. Приглашаем Вас провести самооценку качества дошкольного образования в Вашей группе с использованием онлайн-инструмента, нажав на кнопку «Провести самооценку»";
    }
}