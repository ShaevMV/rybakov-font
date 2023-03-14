<?php

namespace App\Container\Widgets\Factory;


class TalkingWidgets extends AbstractionFactory
{
    use DefaultWidgets;

    protected $template = FactoryWidgets::TALKING;

}