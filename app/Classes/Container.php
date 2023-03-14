<?php

namespace App\Classes;


use App\User;
use Illuminate\Database\Eloquent\Model;

abstract class Container
{

    /**
     * @var
     */
    protected $model;

    /**
     * @var User
     */
    protected $user;


    /**
     * @param User $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }


    /**
     * @param $model
     * @return Container
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }


    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }


}