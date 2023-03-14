<?php

namespace App\Container;


use App\Models\Stage;
use App\User;
use Illuminate\Database\Eloquent\Collection;

interface InterfaceStage
{
    /**
     * Вывести этап
     *
     * @return Stage
     */
    public function getStage();

    /**
     * Вывести пользователя
     *
     * @return User|Collection
     */
    public function getUser();
}