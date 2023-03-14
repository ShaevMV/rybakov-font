<?php

namespace Tests\Unit\Container;


use App\Container\Widgets\Factory\AbstractionFactory;
use App\Container\Widgets\Factory\FactoryWidgets;
use App\Container\Widgets\Factory\SliderWidgets;
use App\Container\Widgets\WidgetsContainer;
use Tests\TestCase;
/*use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;*/

/**
 * - Получить список всех виджитов, вывести экспертов, вывести отзывы
 * - Создание слайдера
 * - Вывести новые параметры для элемента виджита
 *
 * Class WidgetTest
 * @package Tests\Unit\Container
 */
class WidgetTest extends TestCase
{
    /**
     * Получить список всех виджитов, вывести экспертов, вывести отзывы
     *
     * @return void
     */
    public function testGetList()
    {
        $widgets = (new WidgetsContainer())
            ->getList()
            ->keyBy('template')
            ->toArray();

        $this->assertNotEmpty($widgets);
        $this->assertNotEmpty($widgets['experts']['items']);
        $this->assertNotEmpty($widgets['reviews']['items']);
    }

    /**
     * Получение объекта слайдер
     *
     * @dataProvider getWidgetsProvider
     * @param $template
     * @param $widgetClass
     * @param $count
     * @throws \Exception
     */
    public function testGetCreateSlider($template, $widgetClass, $count)
    {
        $widget = FactoryWidgets::getWidget($template);
        $this->assertInstanceOf($widgetClass, $widget);
        $this->assertEquals($widget->getCount(), $count);
        $this->assertNotEmpty($widget->getDataForParam());
    }

    /**
     * Вывод данных для получения сответствующих объёктов
     */
    public function getWidgetsProvider()
    {
        return [
            [FactoryWidgets::SLIDER, SliderWidgets::class, AbstractionFactory::ARRAY_TYPE]
        ];
    }
}
