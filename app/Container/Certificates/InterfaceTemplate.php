<?php

namespace App\Container\Certificates;

interface InterfaceTemplate
{
    public function getTemplate();

    public function getName(): string;
}