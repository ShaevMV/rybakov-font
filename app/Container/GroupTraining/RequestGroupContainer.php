<?php

namespace App\Container\GroupTraining;


use App\Models\GroupRequests;
use App\Models\Level;
use App\Models\Request;
use App\Models\Testing;
use App\Models\Training;
use App\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class RequestGroupContainer
{


    /**
     * Созадать группу для заявок
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function createGroup(string $name, int $levelId)
    {
        return GroupRequests::updateOrCreate([
            'level_id' => $levelId,
            'name' => $name
        ]);
    }

    /**
     * Вывести список групп заявок
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function getListInLevel(int $levelId)
    {
        return GroupRequests::whereLevelId($levelId)
            ->withCount(Request::TABLE)
            ->get();

    }

    /**
     * Вывести заявки для эксперта
     *
     * @param int $directionId
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getListInDirectionForExpert(User $user)
    {
        return (new GroupRequests())->where('expert_id', '=', $user->id)
            ->selectRaw(GroupRequests::TABLE.'.*')
            ->withCount(Request::TABLE)
            ->with(Level::TABLE)
            ->get();
    }

    public function getListInDirectionForUser(int $directionId, User $user)
    {
        return (new Request())
            ->leftJoin(Level::TABLE, function (JoinClause $join) use ($directionId) {
                $join->on(Level::TABLE . '.id', '=', Request::TABLE . '.level_id')
                    ->where(Level::TABLE . '.direction_id', '=', $directionId);
            })
            ->leftJoin(Testing::TABLE, function (JoinClause $join) {
                $join->on(\App\Models\Request::TABLE . '.level_id', '=', Testing::TABLE . '.level_id');
            })
            ->leftJoin(Training::TABLE, function (JoinClause $join) use ($user){
                $join->on(Training::TABLE . '.morphtable_id', '=', Testing::TABLE . '.id')
                    ->where(Training::TABLE . '.user_id','=',$user->id)
                    ->where(Training::TABLE . '.morphtable_type', '=', Testing::class)
                    ->whereNull(Training::TABLE.'.deleted_at');
            })
            ->where(Request::TABLE.'.user_id', '=', $user->id)
            ->with(GroupRequests::TABLE)
            ->select([
                Request::TABLE.'.*',
                Level::TABLE.'.number',
                Training::TABLE . '.passed'
            ])
            ->get()
            ->keyBy('number');
    }

    /**
     * Назначить эксперта для группы заявок
     *
     * @param int $groupRequestsId
     * @param User $expert
     * @return bool
     */
    public static function assignExpertForGroup(int $groupRequestsId, User $expert)
    {
        return (new GroupRequests)->find($groupRequestsId)
            ->update([
               'expert_id' => $expert->id
            ]);
    }

    /**
     * Обновить список групп
     *
     * @param array $updateList
     * @return \App\Models\Task|\Illuminate\Database\Eloquent\Builder
     */
    public static function updateList(array $updateList)
    {
        return GroupRequests::insertOnDuplicateKey($updateList);
    }


    /**
     * Удалить группу для заявок
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public static function delete(int $id)
    {
        Request::whereGroupRequestId($id)
            ->update(['group_request_id' => null]);
        return GroupRequests::findOrFail($id)->delete();
    }

    /**
     * Вывести заявки внутри группы
     *
     * @param int $idGroup
     * @return Request|\Illuminate\Database\Eloquent\Builder
     */
    public static function getRequestGroup(int $idGroup)
    {
        return GroupRequests::findOrFail($idGroup)
            ->load([
                Request::TABLE => function(HasMany $query){
                    $query->leftJoin(Testing::TABLE,function (JoinClause $join){
                        $join->on(Request::TABLE.'.level_id','=',Testing::TABLE.'.id');
                    })->leftJoin(Training::TABLE,function (JoinClause $join){
                        $join->on(Request::TABLE.'.user_id','=',Training::TABLE.'.user_id')
                            ->on(Training::TABLE.'.morphtable_id','=',Testing::TABLE.'.id')
                            ->where(Training::TABLE.'.morphtable_type','=',Testing::class)
                            ->whereNull(Training::TABLE.'.deleted_at');
                    })->select([
                        Request::TABLE.'.*',
                        DB::raw('max('.Training::TABLE.'.id) as training_id'),
                        DB::raw('(CASE
                                    WHEN `'.Training::TABLE.'`.`passed` IS NULL THEN 0
                                    WHEN `'.Training::TABLE.'`.`passed` IS NOT NULL THEN `'.Training::TABLE.'`.`passed` 
                                END) AS passed')
                    ])
                    ->groupBy([
                        Request::TABLE.'.id',
                        Training::TABLE.'.passed',
                        Training::TABLE.'.id',
                    ]);
                }
            ]);
    }



    /**
     * Вывести заявки по определённой группе
     *
     * @param int $idGroup
     * @return Request|\Illuminate\Database\Eloquent\Builder
     */
    public static function getRequestInGroup(int $idGroup)
    {
        return Request::whereGroupRequestId($idGroup);
    }

}