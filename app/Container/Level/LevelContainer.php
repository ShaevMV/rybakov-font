<?php

namespace App\Container\Level;


use App\Models\Level;
use App\Models\MoreDetails;
use Illuminate\Database\Eloquent\Builder;

class LevelContainer implements InterfaceLevel
{

    /**
     * @var int Направление
     */
    protected $idDirections;

    public function __construct(int $idDirections)
    {
        $this->idDirections = $idDirections;
    }


    /**
     * Вывести список уровней по определённому направлению
     *
     * @return Builder
     */
    public function getListlevel() : Builder
    {
        return  Level::where('direction_id','=',$this->idDirections)
            ->with(MoreDetails::TABLE);
    }

    /**
     * Вывести уровень по его номеру
     *
     * @param int $numberLevel
     * @param int $directionId
     * @return Level|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public static function getLevelByNumber(int $numberLevel, int $directionId)
    {
        return Level::where([
            'direction_id' => $directionId,
            'number' => $numberLevel,
        ])->firstOrFail();
    }
}