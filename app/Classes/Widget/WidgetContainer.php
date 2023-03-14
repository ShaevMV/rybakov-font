<?php

namespace App\Classes\Widget;


use App\Classes\Container;
use App\Models\Widget;
use Illuminate\Database\Eloquent\Model;


class WidgetContainer extends Container
{


    public function __construct()
    {
        $this->model = new Widget();
    }

    /**
     * @var array Список шаблонов
     */
    const TEMPLATE_LIST = [
        [
            'name' => 'slider',
            'params' => [
                'image' => 'image',
                'title' => 'string',
                'href' => 'url',
                'button' => 'string'
            ],
            'type' => 'array',
            'count' => '2'
        ],
        [
            'name' => 'participation',
            'params' => [
                'Teacher_1' => 'string',
                'Teacher_2' => 'string',
                'Teacher_3' => 'string',
                'Teacher_Expert' => 'string',
                'Kindergarten_1' => 'string',
                'Kindergarten_2' => 'string',
                'Kindergarten_3' => 'string',
                'Kindergarten_Expert' => 'string',
            ],
            'type' => 'unit',
            'count' => '1'
        ],
        [
            'name' => 'work',
            'params' => [
                'level1' => 'string',
                'level2' => 'string',
                'level3' => 'string',
                'description' => 'string',
            ],
            'type' => 'unit',
            'count' => '1'
        ],
        [
            'name' => 'tools',
            'params' => [
                'nokgo' => 'string',
                'ecers' => 'string',
            ],
            'type' => 'unit',
            'count' => '1'
        ],
        [
            'name' => 'sponsor',
            'params' => [
                'image' => 'image',
            ],
            'type' => 'array',
            'count' => '3'
        ],
        [
            'name' => 'talking',
            'params' => [
                'title' => 'string',
                'text' => 'string',
            ],
            'type' => 'array',
            'count' => '3'
        ],
        [
            'name' => 'youTube',
            'params' => [
                'video' => 'string',
            ],
            'type' => 'unit',
            'count' => '1'
        ],
        [
            'name' => 'experts',
            'params' => [],
            'type' => 'unit',
            'count' => '1'
        ],
        [
            'name' => 'reviews',
            'params' => [],
            'type' => 'unit',
            'count' => '1'
        ],
    ];

    /**
     * @return Widget
     */
    public function getParamsWidget(): Model
    {
        return $this->model;
    }

    /**
     * Вывести все активные виджеты
     *
     * @return array|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getList()
    {
        /** @var Widget $widgets */
        $widgets = $this->getModel();
        $listWidgets = $widgets->getActiveList();
        foreach ($listWidgets as &$widget) {
            if($widget->data_join){
                $widget['items'] = $widget->data_join::whereActive(true)->get();
            } else {
                $widget['items'] = [];
            }
        }

        return $listWidgets;
    }





}