<?php

namespace Tests\Unit\Container;

use App\Container\Lesson\LessonTesting;
use App\Models\AnswerUsers;
use App\Models\Direction;
use App\Models\Task;
use App\Models\Training;
use App\User;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * - Начать прохождения теста / продолжить прохождение теста
 * - получить список в задании урока вопросов в тесте
 * - ответить на вопрос
 * - Проверить что все вопросы в задании отвечены
 * - завершить тест
 * - Проверить что все вопросы в предыдуших заданиях отвечены
 * - Завершить все тестирования в уроке
 *
 * Class LessonTestingTest
 * @package Tests\Unit\Container
 */
class LessonTestingTest extends TestCase
{
    /**
     * Начать прохождения теста / продолжить прохождение теста
     *
     * @return void
     */
    public function testCreateOrGetTraining()
    {
        $class = new \ReflectionClass(LessonTesting::class);
        $method = $class->getMethod('getOrCreateTraining');
        $method->setAccessible(true);
        $obj = new LessonTesting(
            User::find(1),
            (new Task)->find(6));
        $result = $method->invoke($obj);

        $this->assertInstanceOf(Training::class, $result);
        $this->assertEquals(0, $result->passed);
        $this->assertEquals(6, $result->morphtable_id);
    }

    /**
     * получить список в задании урока вопросов в тесте
     */
    public function testGetQuestionsList()
    {
        $task = new LessonTesting(
            User::find(1),
            (new Task)->find(6));
        $taskQuestionsList = $task->getList();

        $this->assertNotEmpty($taskQuestionsList);
        $this->assertArrayHasKey('answer_user', $taskQuestionsList->get()->toArray()[0]);
    }

    /**
     * Ответить на вопрос
     *
     * @return void
     */
    public function testSetAnswer()
    {
        $training = new LessonTesting(
            User::find(1),
            (new Task)->find(6));
        $this->assertInstanceOf(AnswerUsers::class, $training->setAnswer(613, '42'));
        $this->assertEquals('42', json_decode($training->getList()->get()->keyBy('id')[613]->answer_user->answer, false)[0]);
    }

    /**
     * Проверить что все вопросы в тесте отвечены
     */
    public function testCheckAllQuestionsAnswered()
    {
        $training = new LessonTesting(
            User::find(1),
            (new Task)->find(6));
        $this->assertEquals(0, $training->checkAllQuestionsAnswered());
        $training = new LessonTesting(
            User::find(1),
            (new Task)->find(12));
        $this->assertNotEquals(0, $training->checkAllQuestionsAnswered());
    }

    /**
     * Завершаить тестирования
     *
     */
    public function testCompletion()
    {
        $training = new LessonTesting(
            User::find(1),
            (new Task)->find(6));
        $training->complete();
        $this->assertTrue($training->getTraining()->passed);
    }

    /**
     * Проверить что все вопросы в предыдуших заданиях отвечены
     */
    public function testCheckAllQuestionsLesson()
    {
        $task = LessonTesting::getTaskQuestionsNotAnswered(3, 1, 1);
        if ($task) {
            $this->assertNotEmpty($task);
        } else {
            $this->assertFalse($task);
        }
    }

    /**
     * Завершить все тестирования в уроке
     *
     * @throws \Exception
     */
    public function testCompletionAllTraining()
    {
        $task = LessonTesting::completeAllTraining(Direction::getIdForName(Direction::NOKDO), 1);
        $this->assertNotEmpty($task);
    }

}


