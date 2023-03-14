<?php

namespace Tests\Unit;

use App\Classes\Widget\WidgetContainer;
use App\Models\Widget;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Container\Container;

/**
 * Class WidgetTest
 * 1 - создание агригатора Widget (Подключние модели, подключение TemplateWidget)
 * 2 - Получение данных для нужного шаблона
 * 3 - Получить данные для шаблонов экспертов, и отзовов
 *
 * @package Tests\Unit
 */
class WidgetTest extends TestCase
{
    /**
     * Создание агригатора Widget (Подключние модели, подключение TemplateWidget)
     *
     * @throws BindingResolutionException
     */
    public function testWidgetContainer()
    {
        $widget = Container::getInstance()->make(WidgetContainer::class,[
            'model' => (new Widget())]);
        $this->assertInstanceOf(WidgetContainer::class, $widget);
        $this->assertInstanceOf(Widget::class, $widget->getModel());
    }

    /**
     * Вывести все активные виджиты
     *
     * @throws BindingResolutionException
     */
    public function testGetAllParams()
    {
        $container = Container::getInstance();
        $widget = $container->make(WidgetContainer::class,[
            'model' => (new Widget())]);

        $this->assertInstanceOf(
            Collection::class,
            $widget->getList()
        );
    }


}
