<?php

namespace App\Container\Widgets;


use App\Container\Widgets\Factory\AbstractionFactory;
use App\Container\Widgets\Factory\FactoryWidgets;
use App\Models\Widget;



class WidgetsContainer
{

    /**
     * Вывести все активные виджеты
     *
     * @param bool $isKey
     * @return array|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getList(bool $isKey = false)
    {
        /** @var Widget $widgets */
        $widgets = (new Widget())
            ->orderBy('sort', 'asc');
        if($isKey){
            $listWidgets = $widgets->get();
        } else {
            $listWidgets = $widgets->whereActive(true)->get();
        }

        foreach ($listWidgets as &$widget) {
            $widget['items'] = [];
            $widget['params'] = $this->getParams($widget['params'], $isKey);

            if ($count = self::getCount($widget->template)) {
                $widget['countParams'] = $count;
            }
        }

        return $listWidgets;
    }


    /**
     * Вывести массив параметров
     *
     * @param string $params
     * @param bool $isKey
     * @return array
     */
    private static function getParams(string $params, bool $isKey = false): array
    {
        $result = [];
        $paramsAr = json_decode($params, true);
        if ($isKey) {
            foreach ($paramsAr as $key => $item) {
                $result[] = [
                    'params' => $item,
                    'key' => $key
                ];
            }
        } else {
            $result = $paramsAr;
        }

        return $result;
    }

    /**
     * Вывести кол-во записей в параметрах витджета
     *
     * @param $template
     * @return bool|int|string
     */
    private static function getCount($template)
    {
        try{
            return FactoryWidgets::getWidget($template)
                ->getCount();
        } catch (\Exception $e) {
            return false;
        }
    }


}
