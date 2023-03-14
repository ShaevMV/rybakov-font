<?php

namespace App\Container\Widgets\Factory;


use App\Models\Widget;

abstract class AbstractionFactory
{
    const ARRAY_TYPE = 'array';

    protected $template = '';

    /**
     * @var string
     */
    protected $title;
    /**
     * @var int
     */
    protected $sort;
    /**
     * @var string
     */
    protected $dataJoin;
    /**
     * @var array
     */
    protected $param;
    /**
     * @var bool
     */
    protected $active;


    /**
     * @param bool $active
     * @return $this
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
        return $this;
    }
    /**
     * @var bool Указатель массива
     */
    protected $isArray = false;
    /**
     * @var int Количество значений параметра
     */
    protected $count = 1;

    /**
     * @param string $title
     * @return AbstractionFactory
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param int $sort
     * @return AbstractionFactory
     */
    public function setSort(int $sort)
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * @param string $dataJoin
     * @return AbstractionFactory
     */
    public function setDataJoin(string $dataJoin)
    {
        $this->dataJoin = $dataJoin;
        return $this;
    }

    /**
     * @param array $param
     * @return AbstractionFactory
     */
    public function setParam(array $param)
    {
        $this->param = $param;
        return $this;
    }

    /**
     * Вывести данные для нового параметра
     *
     * @return array
     */
    abstract public function getDataForParam(): array;

    /**
     * Обновление параметров
     *
     * @param array $data
     * @return mixed
     */
    abstract public function updateParams(array $data = []);

    /**
     * Вывести коичество записей или массив
     *
     * @return string|int
     */
    public function getCount()
    {
        return !$this->isArray ? $this->count : self::ARRAY_TYPE;
    }

    /**
     * Сохранить
     *
     * @return bool|int
     */
    public function save()
    {
        return Widget::whereTemplate($this->template)
            ->update([
                'title' => $this->title,
                'sort' => $this->sort,
                'active' => $this->active,
                'params' => json_encode($this->param)
            ]);
    }

}