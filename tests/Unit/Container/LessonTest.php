<?php

namespace Tests\Unit\Container;

use App\Container\Lesson\LessonContainer;
use App\Models\Direction;
use App\Models\Lesson;
use App\Models\Stage;
use App\Models\Task;
use App\User;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * - Получить список доступных уроков с заданиями
 * - Записать задания
 * - Получить последнее пройденое задания
 * - Получить этап урока
 * - Завершить обучение
 * - Получить сертификат о прохождении онлайн обучения
 *
 * Class LessonTest
 * @package Tests\Unit\Container
 */
class LessonTest extends TestCase
{
    /**
     * Получить список доступных уроков с заданиями
     *
     * @dataProvider directionProvider
     * @return void
     */
    public function testGetListLesson(int $idDirection)
    {
        $lessonList = (new LessonContainer(User::find(1), $idDirection))->getList();
        $this->assertNotEmpty($lessonList);
        $this->assertArrayHasKey('tasks', $lessonList->toArray()[0]);
    }


    /**
     * Записать задания
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     */
    public function testSetSelectTask(int $idDirection)
    {
        $taskId = Lesson::whereDirectionId($idDirection)->first()->tasks()->first()->id;
        $lesson = new LessonContainer(User::find(1), $idDirection);
        $this->assertTrue($lesson->selectTask($taskId));
        $this->assertEquals($taskId, $lesson->getLastSelectTask()->task_id);
    }

    /**
     * Получить последнее пройденое задания
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     */
    public function testGetLastSelectTask(int $idDirection)
    {
        $lesson = new LessonContainer(User::find(1), $idDirection);

        if ($taskSelect = $lesson->getLastSelectTask()) {
            $this->assertInstanceOf(Task::class, $taskSelect->tasks);
        } else {
            $this->assertNull($taskSelect);
        }

    }

    /**
     * Получить этап урока
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     */
    public function testGetStageForLesson(int $idDirection)
    {
        $stage = (new LessonContainer(User::find(1), $idDirection))->getStage();
        $this->assertNotEmpty($stage);
        $this->assertInstanceOf(Stage::class, $stage);
    }

    /**
     * Завершить обучение
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     */
    public function testCompleteLesson(int $idDirection)
    {
        $lesson = new LessonContainer(User::find(1), $idDirection);
        $lesson->complete();
        $this->assertEmpty($lesson->getLastSelectTask());
    }

    public function directionProvider()
    {
        return [
            [Direction::ID_NOKDO],
            [Direction::ID_ECERS]
        ];
    }


}
