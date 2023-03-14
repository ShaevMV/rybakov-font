<?php

namespace App\Container\Widgets\Factory;


trait DefaultWidgets
{
    /**
     * @return array
     */
    public function getDataForParam(): array
    {
        return [];
    }

    /**
     * @param array $data
     * @return mixed|void
     * @throws \Exception
     */
    public function updateParams(array $data = [])
    {

    }
}