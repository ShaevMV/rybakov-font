<?php

namespace App\Container\Certificates;


use App\Container\Container;
use App\Models\Certificate;
use App\User;

class CertificatesContainer extends Container
{
    /**
     * @return $this|mixed
     */
    protected function getModel()
    {
        return Certificate::whereUserId($this->user->id);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getList()
    {
        return $this->storage->get();
    }

    /**
     * Вывести список всех сертификатов
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    /**
     * @return $this|\Illuminate\Database\Query\Builder
     */
    public static function getAllList()
    {
        return Certificate::leftJoin(User::TABLE, User::TABLE . '.id', '=', Certificate::TABLE . '.user_id')
            ->select([
                Certificate::TABLE.'.*',
                User::TABLE.'.email',
                User::TABLE.'.name'
            ]);
    }
}