<?php

namespace App\Http\Controllers\Api\v1;

use App\Container\Widgets\Factory\FactoryWidgets;
use App\Container\Widgets\Image;
use App\Container\Widgets\WidgetsContainer;
use App\Http\Controllers\Controller;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    /**
     * @var WidgetsContainer
     */
    private $widgets;

    /**
     * WidgetController constructor.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->widgets = Container::getInstance()
            ->make(WidgetsContainer::class);

        $this->middleware(['auth:api','admin'], ['only' => [
            'store',
            'update',
            'destroy',
        ]]);
    }

    /**
     * Вывести список всех виджетов
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response()->json(
            $this->widgets->getList()
        );
    }

    /**
     * Вывести список всех виджетов для админки
     *
     * @return \Illuminate\Http\Response
     */
    public function getListForAdmin()
    {
        return Response()->json(
            $this->widgets->getList(true)
        );
    }


    /**
     * Сохранить изображения во временной папке для просмотра
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadImage(Request $request)
    {

        $tempPath = empty($request->get('temp')) ? true :
            filter_var($request->get('temp'),FILTER_VALIDATE_BOOLEAN);

        $image = new Image($request->file('file'));
        if ($image->valid()) {
            return response()->json([
                'file' => $image->saveImage($tempPath),
            ]);
        } else {
            return response()->json([
                'error' => Image::ERROR_FILE_NOT_TYPE,
            ], 420);
        }
    }

    /**
     * Вывести дланные для добавления элемента в виджет
     *
     * @param $template
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNewParams($template)
    {
        try {
            return response()->json([
                'param' => FactoryWidgets::getWidget($template)->getDataForParam(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 420);
        }
    }

    /**
     * Вывести дланные для добавления элемента в виджет
     *
     * @param $template
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateWidget($template, Request $request)
    {
        $widget = FactoryWidgets::getWidget($template);
        $widget->setParam($request->get('params'))
            ->setTitle($request->get('title'))
            ->setSort($request->get('sort'))
            ->setActive($request->get('active'))
            ->updateParams($request->get('data'));

        if($widget->save()){
            $result = response()->json('OK!!!');
        } else {
            $result = response()->json([
                'error' => 'not Save!!!',
            ], 420);
        }
        return $result;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJoinData(Request $request)
    {
        $model = $request->get('dataJoin');
        return response()->json([
            'data' => $model::whereActive(true)->get()
        ]);
    }


}
