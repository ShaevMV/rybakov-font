<?php

namespace Tests\Unit\Container;


use App\Container\GroupTraining\RequestContainer;
use App\Container\Testing\TestingContainer;
use App\Container\Lesson\LessonContainer;
use App\Container\Level\LevelContainer;
use App\Container\Progress\ProgressContainer;
use App\Container\Testing\TrainingsContainer;
use App\Models\Direction;
use App\User;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * - Получить списко всех пройденных уровней и этапов у пользователя
 * - Завершить этап (урока, теста)
 *
 *
 * Class ProgressTest
 * @package Tests\Unit\Container
 */
class ProgressTest extends TestCase
{
    /**
     * Получить список всех пройденных уровней и этапов у пользователя
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     * @return void
     */
    public function testGetList(int $idDirection)
    {
        $progress = (new ProgressContainer(User::find(1),
            $idDirection))->getList();
        $this->assertNotEmpty($progress);
        $this->assertArrayHasKey('stages', $progress->toArray()[0]);
        $this->assertArrayHasKey('levels', $progress->toArray()[0]);

    }

    public function directionProvider()
    {
        return [
            [Direction::ID_NOKDO],
            [Direction::ID_ECERS]
        ];
    }

    /**
     * Завершить этап урока
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     */
    public function testCompleteLesson(int $idDirection)
    {
        $lesson = new LessonContainer(User::find(1), $idDirection);
        $progress = ProgressContainer::complete($lesson);
        $this->assertTrue($progress);
    }

    /**
     * Завершить этап офлайн встречи для нескольких пользоватлей
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     */
    public function testCompleteGroupTraining(int $idDirection)
    {
        $group = new RequestContainer(User::find([1,2]), $idDirection);
        $progress = ProgressContainer::complete($group);
        $this->assertTrue($progress);
    }

    /**
     * Завершить тест
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     */
    public function testCompleteTesting(int $idDirection)
    {
        $training = new TrainingsContainer(
            User::find(1),
            (new TestingContainer(LevelContainer::getLevelByNumber(1, $idDirection)))
                ->getTesting());
        $progress = ProgressContainer::complete($training);
        $this->assertTrue($progress);
    }

    public function stageProvider()
    {
        return [
            [1],
            [7],
            [1],
        ];
    }
}
