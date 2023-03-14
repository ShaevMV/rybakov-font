<?php

namespace App\Facade;
use Illuminate\Support\Facades\Facade;

class StaticFacade extends Facade
{
    protected static function getFacadeAccessor() {
        return 'StaticData';
    }
}