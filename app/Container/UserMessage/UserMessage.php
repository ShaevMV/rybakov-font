<?php

namespace App\Container\UserMessage;


use App\Container\InterfaceStage;
use App\Models\Direction;

abstract class UserMessage
{
    const LEVEL_1 = 1;
    const LEVEL_2 = 2;
    const LEVEL_3 = 3;
    const LEVEL_4 = 4;

    protected $interfaceStage;
    protected $level;
    protected $directionRus;

    public function __construct(InterfaceStage $interfaceStage)
    {
        $this->interfaceStage = $interfaceStage;
        $this->level = $interfaceStage->getStage()->levels;
        $this->directionRus = Direction::DIRECTION_LIST_RUS[$this->level->direction_id];
    }

    abstract public function getModalMessage(): string;
}