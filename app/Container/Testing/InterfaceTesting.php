<?php


namespace App\Container\Testing;


use App\Models\Testing;

interface InterfaceTesting
{
    /**
     * Вывести тест
     *
     * @return Testing
     */
    public function getTesting(): Testing;

}