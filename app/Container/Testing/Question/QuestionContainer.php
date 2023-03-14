<?php


namespace App\Container\Testing\Question;


use App\Http\Requests\QuestionRequest;

class QuestionContainer
{
    /**
     * @var QuestionRequest
     */
    protected $questionRequest;

    /**
     * @var QuestionModel
     */
    protected $questionModel;
    protected $questionType;


    public function __construct(QuestionModel $questionModel, string $questionType)
    {
        $this->questionModel = $questionModel;
        $this->questionType = $questionType;
    }
}