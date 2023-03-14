<?php

namespace App\Container\Notification;


class CreateNotification
{
    /**
     * Вывести класс для создания уведомления
     *
     * @param int $user_id
     * @param InterfaceNotification $interfaceNotification
     * @param string|null $email
     * @return NotificationContainer|null
     */
    public static function getNotification(int $user_id, InterfaceNotification $interfaceNotification, string $email = null): ?NotificationContainer
    {
        $result = null;
        if(!empty($interfaceNotification->getMessage())){
            $result = new NotificationContainer(
                $user_id,
                $interfaceNotification->getMessage(),
                $email
            );
        }
        return $result;
    }


}