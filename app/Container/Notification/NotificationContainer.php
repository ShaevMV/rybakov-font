<?php

namespace App\Container\Notification;


use App\Models\Notification;
use App\Notifications\UserNotification;
use App\User;
use Carbon\Carbon;

class NotificationContainer
{
    public static function send(User $user,string $message)
    {
        $when = Carbon::now()->addSeconds(5);

        if(!$user->notifications()->whereRaw('JSON_EXTRACT(data, "$.message") = "'.$message.'"')->exists()){
            \Log::debug($message);
            $user->notify((new UserNotification($message))->delay($when));
        }

    }

    /**
     * Вывисти список уведомлений
     *
     * @param int $user_id
     * @return Notification|\Illuminate\Database\Eloquent\Builder
     */
    public static function getList(int $user_id)
    {
        return Notification::whereUserId($user_id)
            ->orderBy('updated_at','desc');
    }

}