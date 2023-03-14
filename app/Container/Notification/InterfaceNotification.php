<?php

namespace App\Container\Notification;


interface InterfaceNotification
{
    /**
     * Текст сообщения
     *
     * @return string
     */
    public function getMessage(): string;
}