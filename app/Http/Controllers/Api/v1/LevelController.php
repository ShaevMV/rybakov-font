<?php

namespace App\Http\Controllers\Api\v1;

use App\Container\Level\LevelContainer;
use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\MoreDetails;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Вывести список уровней с описанием
     *
     * @param string $type
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getList(string $type)
    {
        return response()->json(
            (new LevelContainer(Direction::getIdForName($type)))
                ->getListlevel()
                ->where('number','<',4)
                ->get()
        );
    }

    /**
     * Обновить детальную информацию о уровне
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateMoreDetail(int $id,Request $request)
    {
        $result = MoreDetails::whereId($id)
            ->update($request->all());
        return response()->json(
            'OK!!!',$result ? 200 : 420
        );


    }
}
