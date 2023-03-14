<?php

namespace App\Classes;

use Illuminate\Support\Facades\Redis;
use App\Models\Setting;

/**
 * Class StaticData
 *
 * Класс для работы со статистическими данными
 * @package App\Classes
 */
class StaticData
{
    /**
     * Выдать статистические данные из настроек
     *
     * @param string $name
     * @return bool
     */
    public function getDataForSettings(string $name)
    {
        if (!$setting = Redis::get('setting:')) {
            Redis::set('setting:', Setting::all());
            $setting = Redis::get('setting:');
        }
        $arSetting = json_decode($setting);
        $key = array_search($name,
            array_column(
                $arSetting, 'name'
            )
        );

        return $arSetting[$key]->value ?? false;
    }
}