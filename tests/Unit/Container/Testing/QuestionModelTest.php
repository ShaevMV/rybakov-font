<?php

namespace Tests\Unit\Container\Testing;

use App\Container\Testing\Question\QuestionModel;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Tests\TestCase;
use \Illuminate\Container\Container;

/**
 * + Получение вопроса из базы
 * + создание нового вопроса
 * - Сохронения вопроса
 * - изменения вопроса
 *
 * Class QuestionModelTest
 * @package Tests\Unit\Container\Testing
 */
class QuestionModelTest extends TestCase
{
    /**
     * Получение вопроса из базы
     *
     * @return void
     */
    public function testGetModelInBD()
    {
        $model = new QuestionModel(1);
        $this->assertInstanceOf(Question::class, $model->getModel());
    }

    /**
     * создание нового вопроса
     *
     * @return void
     */
    public function testGetModelInNew()
    {
        $model = new QuestionModel();
        $this->assertInstanceOf(Question::class, $model->getModel());
    }


    public function testSaveModel()
    {
        $questionRequest = new QuestionRequest();
        $questionRequest->replace([
            'text' => 'fsdfd',
            'options' => [
                [
                    'answer' => 'dsw',
                    'right' => false,
                ],
                [
                    'answer' => 'dsw',
                    'right' => true,
                ],
                [
                    'answer' => 'dsw',
                    'right' => false,
                ],
            ],
            'type' => Question::QUESTION_OPTION_TYPE,
            'testing_id' => 1
        ]);

        $model = new QuestionModel();
        $this->assertTrue($model->save($questionRequest,1));
    }

}
