<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Вывести список уведомлений
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $result = [];
        $notificationList = \Auth::user()->notifications;
        $notificationList->markAsRead();
        foreach ($notificationList as $item) {
            $result[] = $item->data;
        }
        return response()->json([
            "notificationList" => $result
        ]);
    }

    /**
     * Вывести список уведомлений
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCount()
    {
        return response()->json(
            \Auth::user()->unreadNotifications()->count()
        );
    }


}
