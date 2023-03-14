<?php

namespace Tests\Unit\Container;

use App\Container\Level\LevelContainer;
use \App\Container\Testing\TestingContainer;
use App\Container\Testing\TrainingsContainer;
use App\Models\AnswerUsers;
use App\Models\Direction;
use App\Models\Lesson;
use App\Models\Stage;
use App\Models\Testing;
use App\Models\Training;
use App\User;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * - Вывести тест по его уровню
 * - Начать прохождения теста
 * - получить список вопросов в тесте
 * - ответить на вопрос
 * - Проверить что все вопросы в тесте отвечены
 * - Вывести этап тестирования
 * - завершить тест
 *
 * Class TestingTest
 * @package Tests\Unit\Container
 */
class TestingTest extends TestCase
{

    /**
     * Вывести тест по его уровню
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     */
    public function testGetTestingByLevel(int $idDirection)
    {
        $testing = new TestingContainer(LevelContainer::getLevelByNumber(1, $idDirection));

        $this->assertInstanceOf(Testing::class, $testing->getTesting());
    }

    /**
     * Начать прохождения теста / продолжить прохождение теста
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     */
    public function testCreateOrGetTraining(int $idDirection)
    {
        $class = new \ReflectionClass(TrainingsContainer::class);
        $method = $class->getMethod('getOrCreateTraining');
        $method->setAccessible(true);
        $testing = (new TestingContainer(
            LevelContainer::getLevelByNumber(1, $idDirection)
        ))->getTesting();
        $obj = new TrainingsContainer(
            User::find(1),
            $testing);
        $result = $method->invoke($obj);

        $this->assertInstanceOf(Training::class, $result);
        $this->assertEquals(0, $result->passed);
        $this->assertEquals($testing->id, $result->morphtable_id);
    }

    /**
     * получить список вопросов в тесте
     *
     * @dataProvider directionProvider
     *
     * @return void
     */
    public function testGetQuestionsList(int $idDirection)
    {
        $training = new TrainingsContainer(
            User::find(1),
            (new TestingContainer(LevelContainer::getLevelByNumber(1, $idDirection)))
                ->getTesting());
        $testing = $training->getList();

        $this->assertNotEmpty($testing);
        $this->assertArrayHasKey('answer_user', $testing->get()->toArray()[0]);
    }

    /**
     * Ответить на вопрос
     *
     * @return void
     */
    public function testSetAnswer()
    {
        $training = new TrainingsContainer(
            User::find(1),
            Testing::find(1));
        $this->assertInstanceOf(AnswerUsers::class, $training->setAnswer(1, '0'));
        $this->assertInstanceOf(AnswerUsers::class, $training->setAnswer(2, '1'));
        $this->assertEquals('0', json_decode($training->getList()->get()->keyBy('id')[1]->answer_user->answer,false)[0]);
        $this->assertEquals('1', json_decode($training->getList()->get()->keyBy('id')[2]->answer_user->answer,false)[0]);

    }

    /**
     * Проверить что все вопросы в тесте отвечены
     */
    public function testCheckAllQuestionsAnswered()
    {
        $training = new TrainingsContainer(
            User::find(1),
            Testing::find(1));
        $this->assertEquals(0, $training->checkAllQuestionsAnswered());
        $training = new TrainingsContainer(
            User::find(1),
            Testing::find(2));
        $this->assertNotEquals(0, $training->checkAllQuestionsAnswered());
    }


    /**
     * Завершаить тестирования
     *
     * @dataProvider directionProvider
     */
    public function testCompletion(int $idDirection)
    {
        $training = new TrainingsContainer(
            User::find(1),
            (new TestingContainer(LevelContainer::getLevelByNumber(1, $idDirection)))
                ->getTesting());
        $training->complete();
        $this->assertTrue($training->getTraining()->passed);
    }

    /**
     * Получить этап тестирования
     *
     * @dataProvider directionProvider
     */
    public function testStage(int $idDirection)
    {
        $training = new TrainingsContainer(
            User::find(1),
            (new TestingContainer(LevelContainer::getLevelByNumber(1, $idDirection)))
                ->getTesting());
        $this->assertInstanceOf(Stage::class, $training->getStage());
        $this->assertEquals(2, $training->getStage()->number);
    }


    public function directionProvider()
    {
        return [
            [Direction::ID_NOKDO],
            [Direction::ID_ECERS]
        ];
    }
}
