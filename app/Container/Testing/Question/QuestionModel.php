<?php

namespace App\Container\Testing\Question;
use App\Models\AnswerOptions;
use App\Models\Direction;
use App\Models\Question;

class QuestionModel
{


    /**
     * @var \Illuminate\Database\Eloquent\Builder|Question
     */
    protected $modelQuestion;


    /**
     * QuestionModel constructor.
     * @param null $idQuestion
     */
    public function __construct(int $idQuestion = 0)
    {
        if($idQuestion > 0) {
            $this->modelQuestion = Question::whereId($idQuestion)->first();
        } else {
            $this->modelQuestion = new Question();
        }
    }

    /**
     * @return Question|\Illuminate\Database\Eloquent\Builder
     */
    public function getModel()
    {
        return $this->modelQuestion;
    }

    /**
     * Сохранение  вопроса
     *
     * @param array $data
     * @param array $options
     * @return bool
     */
    public function save(array $data,array $options)
    {
        $this->modelQuestion->text =$data['text'];
        $this->modelQuestion->type = $data['type'];
        $this->modelQuestion->comment = $data['comment'];
        $this->modelQuestion->options = \GuzzleHttp\json_encode($options);
        return $this->modelQuestion->save();
    }


    /**
     * Вывести варианты ответов для глобального тестирования
     *
     * @param string $typeDirection
     * @return array
     */
    public static function getOptionsForTesting(string $typeDirection):array
    {
        $count = $typeDirection == Direction::NOKDO ?
            AnswerOptions::COUNT_NOKDO :
            AnswerOptions::COUNT_ECERS;
        $i = $typeDirection == Direction::NOKDO ? 0: 1;
        $options = [];
        while ($i  <= $count) $options[] = [
            'answer' => $i++,
            'right' => ''
        ];
        return $options;

    }




}