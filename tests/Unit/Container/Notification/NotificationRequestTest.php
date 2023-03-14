<?php

namespace Tests\Unit\Container\Notification;

use App\Container\Notification\NotificationMessageRequest;
use Tests\TestCase;

/**
 * Назначен експерт
 * Назначение места и время для встречи
 * Открытие доступа к тестированию
 *
 * Class NotificationRequestTest
 * @package Tests\Unit\Container\Notification
 */
class NotificationRequestTest extends TestCase
{
    /**
     * Назначен експерт
     *
     * @return void
     */
    public function testAssignedExpert()
    {
        $requestArr = [
            "id" => 2,
            "user_id" => 1,
            "group_request_id" => null,
            "level_id" => 2,
            "city" => "test",
            "fio" => "Колобов Ярослав Романович",
            "phone" => "+1-474-716-1674",
            "email" => "admin@admin.ru",
            "payment_subject" => 0,
            "check" => 0,
            "created_at" => "2019-09-24 13:49:34",
            "updated_at" => "2019-09-24 13:49:34",
        ];

        $test = new NotificationMessageRequest($requestArr,NotificationMessageRequest::ASSIGNED_EXPERT_TYPE);
        $this->assertNotEmpty($test->getMessage());
    }

    /**
     * Назначение места и время для встречи
     *
     * @return void
     */
    public function testPlaceAndTime()
    {
        $requestArr = [
            "id" => 2,
            "user_id" => 1,
            "group_request_id" => null,
            "level_id" => 2,
            "city" => "test",
            "fio" => "Колобов Ярослав Романович",
            "phone" => "+1-474-716-1674",
            "email" => "admin@admin.ru",
            "payment_subject" => 0,
            "check" => 0,
            "created_at" => "2019-09-24 13:49:34",
            "updated_at" => "2019-09-24 13:49:34",
        ];

        $test = new NotificationMessageRequest($requestArr,NotificationMessageRequest::PLACE_TYPE);
        $this->assertNotEmpty($test->getMessage());
    }

    /**
     * Назначение места и время для встречи
     *
     * @return void
     */
    public function testAccesseForTesting()
    {
        $requestArr = [
            "id" => 2,
            "user_id" => 1,
            "group_request_id" => null,
            "level_id" => 2,
            "city" => "test",
            "fio" => "Колобов Ярослав Романович",
            "phone" => "+1-474-716-1674",
            "email" => "admin@admin.ru",
            "payment_subject" => 0,
            "check" => 0,
            "created_at" => "2019-09-24 13:49:34",
            "updated_at" => "2019-09-24 13:49:34",
        ];

        $test = new NotificationMessageRequest(2,NotificationMessageRequest::ACCESSE_FOR_TESTING);
        dd($test->getMessage());
        $this->assertNotEmpty($test->getMessage());
    }

}
