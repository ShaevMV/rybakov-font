<?php

namespace App\Container;


use App\Models\Level;
use App\Models\Stage;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

abstract class Container
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var int Направление
     */
    protected $directionId;

    /**
     * @var Builder
     */
    protected $storage;

    /**
     * Container constructor.
     *
     * @param User $user Пользователь
     * @param int $directionId направления
     * @param null $storage модель
     */
    public function __construct(User $user, int $directionId = 0, $storage = null)
    {
        $this->user = $user;
        $this->directionId = $directionId;
        $this->setStorage($storage);
    }

    /**
     * Присоеденить этапы и уровни
     *
     * @param Builder $builder
     * @return Builder
     */
    protected function joinTable(Builder $builder): Builder
    {
        $table = $builder->getModel()->getTable();

        return $builder->join(Stage::TABLE,Stage::TABLE. '.id', '=', $table . '.stage_id')
        ->join(Level::TABLE, function (JoinClause $join) {
            $join->on(Level::TABLE . '.id', '=', Stage::TABLE . '.level_id')
                ->where('direction_id', '=', $this->directionId);
        });
    }

    /**
     * Получить модель
     *
     * @return mixed
     */
    abstract protected function getModel();

    /**
     * Записать хранилище
     *
     * @param mixed $storage
     */
    public function setStorage($storage = null): void
    {
        if(empty($storage)){
            $this->storage = $this->getModel();
        } else {
            $this->storage = $storage;
        }
    }

    /**
     * Вывести данные модели
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    abstract public function getList();

}