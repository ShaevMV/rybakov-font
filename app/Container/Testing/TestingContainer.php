<?php

namespace App\Container\Testing;


use App\Models\Level;
use App\Models\Testing;


class TestingContainer implements InterfaceTesting
{

    /**
     * @var Level
     */
    private $level;


    public function __construct(Level $level)
    {
        $this->level = $level;
    }


    /**
     * Вывести тест
     *
     * @return Testing
     */
    public function getTesting(): Testing
    {
        return $this->level->testings;
    }

}