<?php

namespace App\Container\Kindergarten;


use App\Models\Organization;
use App\Models\Role;
use App\User;
use Illuminate\Database\Query\JoinClause;

class KindergartenContainer
{

    /**
     * @var $this
     */
    private $kindergartensModal;

    public function __construct()
    {
        $this->kindergartensModal = Organization::leftJoin(User::TABLE,function (JoinClause $join){
            $join->on(User::TABLE.'.organization_id','=',Organization::TABLE.'.id')
                ->where(User::TABLE.'.role_id','=',Role::ID_KINDERGARTEN);
        });
    }

    /**
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function getKindergartens()
    {
        return  $this->kindergartensModal
            ->select([
                Organization::TABLE.'.*'
            ]);
    }

    /**
     * @param int $id
     * @param float $long
     * @param float $width
     * @return bool
     */
    public static function saveCoordinates(int $id, float $long, float $width)
    {
        return Organization::where('id','=',$id)->update([
            'long' => $long,
            'width' => $width
        ]);
    }
}