<?php

namespace App\Http\Controllers\Api\v1;


use App\Container\Level\LevelContainer;
use App\Container\Progress\ProgressContainer;
use App\Http\Controllers\Controller;
use App\Models\Direction;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

class ProgressController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Вывести список всех доступных уровней по всем направлениям
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getAvailableLevelAll()
    {
        return response()->json([
            Direction::NOKDO => Container::getInstance()
                ->make(ProgressContainer::class,[
                    'user' => \Auth::user(),
                    'directionId' => Direction::ID_NOKDO])
                ->getList(),
            Direction::ECERS => Container::getInstance()
                ->make(ProgressContainer::class,[
                    'user' => \Auth::user(),
                    'directionId' => Direction::ID_ECERS])
                ->getList(),
        ]);
    }

    /**
     * Вывести список всех доступных уровней по всем направлениям
     *
     * @param string $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAvailableLevel(string $type)
    {
        try{
            return response()->json([
                'level' => (new LevelContainer(Direction::getIdForName($type)))
                    ->getListlevel()->get(),
                'progress' => Container::getInstance()
                    ->make(ProgressContainer::class,[
                        'user' => \Auth::user(),
                        'directionId' => Direction::getIdForName($type)])
                    ->getList()
            ]);
        } catch (\Exception $exception) {
            return response()->json([ 'error' => $exception->getMessage()],420);
        }
    }

    /**
     * Вывести русское название направления по его типу
     *
     * @param string $type
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getNameDirection(string $type)
    {
        return response()->json([
            'name' => Direction::DIRECTION_LIST_RUS[Direction::getIdForName($type)]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
