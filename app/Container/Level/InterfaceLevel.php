<?php

namespace App\Container\Level;


interface InterfaceLevel
{
    /**
     * Вывести уровень по его номеру
     *
     * @param int $numberLevel
     * @param int $directionId
     * @return mixed
     */
    public static function getLevelByNumber(int $numberLevel, int $directionId);
}