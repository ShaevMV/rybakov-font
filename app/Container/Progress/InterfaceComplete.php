<?php

namespace App\Container\Progress;

use App\Container\InterfaceStage;

interface InterfaceComplete
{
    public static function complete(InterfaceStage $interfaceStage);
}