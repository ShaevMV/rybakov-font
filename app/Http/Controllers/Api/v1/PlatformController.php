<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\PlatformRequest;
use App\Models\Platform;
use function GuzzleHttp\Promise\each_limit_all;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlatformController extends Controller
{
    /**
     * Вывести список платформ
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            Platform::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlatformRequest $request)
    {
        $data = [
            'title' =>  $request->get('title'),
            'link' =>  $request->get('link'),
            'active' =>  $request->get('active'),
        ];
        if($id = $request->get('id')){
            Platform::findOrFail($id)
                ->update($data);
        } else {
            Platform::create($data);
        }
        return response()->json('OK!!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        return response()->json(
            Platform::findOrFail($id)->delete($id)
        );
    }
}
