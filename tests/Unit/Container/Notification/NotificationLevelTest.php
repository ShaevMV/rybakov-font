<?php

namespace Tests\Unit\Container\Notification;

use App\Container\GroupTraining\RequestContainer;
use App\Container\Lesson\LessonContainer;
use App\Container\Notification\CreateNotification;
use App\Container\Notification\NotificationContainer;
use App\Container\Notification\NotificationMessageLevel;
use App\Container\Testing\TestingContainer;
use App\Container\Testing\TrainingsContainer;
use App\Models\Direction;
use App\Models\Level;
use App\User;
use Tests\TestCase;

/**
 * Получить уведомление о прохождение онлайн обучения
 * Получить уведомление по переходу на новый уровень
 * Получить уведомление о подачи заявки Пользователю / Админу
 * Получить уведомление о доступа к тестированию
 * Получить уведомление о мнение эксперта по тесту
 *
 * Class NotificationTest
 * @package Tests\Unit\Container
 */
class NotificationLevelTest extends TestCase
{
    /**
     * Получить уведомление по окончанию онлайн обучение
     *
     * @return void
     */
    public function testLessonEnd()
    {
        $notificationContainer = CreateNotification::getNotification(
            1,
            new NotificationMessageLevel(new LessonContainer(User::find(1), 1))
        );
        $notificationContainer->set();

        $this->assertInstanceOf(NotificationContainer::class, $notificationContainer);
        $this->assertEquals(
            sprintf(NotificationMessageLevel::MESSAGE_LESSON, Direction::DIRECTION_LIST_RUS[1]),
            $notificationContainer->getMessage());
    }


    /**
     * Получить уведомление по завершению уровня
     *
     * @dataProvider levelProvider
     * @return void
     */
    public function testTestingEnd($levelId)
    {
        $level = Level::find($levelId);
        $testing = (new TestingContainer($level))->getTesting();
        $notificationContainer = CreateNotification::getNotification(
            1,
            new NotificationMessageLevel(new TrainingsContainer(User::find(1), $testing))
        );

        $notificationContainer->set();

        $this->assertInstanceOf(NotificationContainer::class, $notificationContainer);
        $this->assertEquals(
            sprintf(NotificationMessageLevel::MESSAGE_TEST,
                $level->number,
                Direction::DIRECTION_LIST_RUS[$level->direction_id]),
            $notificationContainer->getMessage());
    }

    public function levelProvider()
    {
        return [
            [1],
            [2],
            [3],
            [5],
            [6],
            [7],
        ];
    }

    /**
     * Получить уведомление по подачи заявления
     *
     * @dataProvider levelProvider
     * @return void
     */
    public function testNotificationPushRequest($levelId)
    {
        if($levelId !== 1 && $levelId !== 5){
            $user = User::find(1);
            RequestContainer::setGroupTraining([
                'user_id' => $user->id,
                'city' => 'test',
                'level_id' => $levelId,
                'fio' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
            ]);
            $level = Level::find($levelId);
            $notificationContainer = CreateNotification::getNotification(
                1,
                new NotificationMessageLevel(new RequestContainer($user, $level))
            );

            $notificationContainer->set();

            $this->assertInstanceOf(NotificationContainer::class, $notificationContainer);
            if($level->number == 2){
                $text = NotificationMessageLevel::MESSAGE_REQUEST_LEVEL2;
            } else {
                $text = NotificationMessageLevel::MESSAGE_REQUEST_LEVEL3;
            }

            $this->assertEquals(
                sprintf($text,
                    Direction::DIRECTION_LIST_RUS[$level->direction_id]),
                $notificationContainer->getMessage());
        } else {
            $this->assertTrue(true);
        }

    }

    /**
     * Получить список уведомлений
     *
     * @dataProvider
     * @return void
     */
    public function testGetList()
    {
        $this->assertNotNull(NotificationContainer::getList(1)->get());
    }

}
