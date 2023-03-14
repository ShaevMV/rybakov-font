<?php

namespace App\Http\Controllers\Api\v1;

use App\Container\Kindergarten\KindergartenContainer;
use App\Http\Controllers\Controller;
use App\Http\Requests\CoordinateRequest;

class KindergartenController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    public function getList()
    {
        return response()->json([
            'list' => (new KindergartenContainer())
                ->getKindergartens()
                ->get()
            //->paginate(Testing::PAGINATE_COUNT, ['*'], 'page', $page)
        ]);
    }

    public function saveCoordinates(int $id, CoordinateRequest $request)
    {
        $result = KindergartenContainer::saveCoordinates($id, $request->get('long'), $request->get('width'));
        return response()->json('OK!!!', $result ? 200 : 420);
    }
}
