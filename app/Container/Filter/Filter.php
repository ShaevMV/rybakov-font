<?php

namespace App\Container\Filter;

use App\Container\GroupTraining\RequestContainer;
use Illuminate\Database\Eloquent\Builder;

class Filter
{
    /**
     * @var array
     */
    private $filter;
    /**
     * @var Builder
     */
    private $builder;

    /**
     * Filter constructor.
     * @param RequestContainer|Builder $builder
     * @param array $filter
     */
    public function __construct(Builder $builder, array $filter)
    {
        $this->filter = $filter;
        $this->builder = $builder;
    }

    /**
     * Вывести примененный фильтр
     *
     * @return Builder
     */
    public function getFilter(): Builder
    {
        foreach ($this->filter as $key => $item) {
            if (!empty($item)) {
                if(is_array($item)){
                    if(!empty($item[0]) && !empty($item[1]))
                    $this->builder = $this->builder->whereBetween($key,[$item[0],$item[1]]);
                } else {
                    $this->builder = $this->builder->where($key,$item);
                }
            }
        }
        return $this->builder;
    }
}