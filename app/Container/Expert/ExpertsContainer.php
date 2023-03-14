<?php

namespace App\Container\Expert;


use App\Models\Expert;
use App\Models\Role;
use App\User;

class ExpertsContainer
{
    /**
     * Вывести список экспертов
     *
     * @return Expert|\Illuminate\Database\Eloquent\Builder
     */
    public function getList()
    {
        return User::whereRoleId(Role::ID_EXPERT);
    }
}