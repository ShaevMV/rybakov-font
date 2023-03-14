<?php

namespace App\Models;


/**
 * App\Models\Direction
 *
 * @property int $id
 * @property string $name название направления
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Level[] $levels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 */
class Direction extends Model
{
    const DIRECTION_LIST_RUS =[
        self::ID_NOKDO => 'НОК ДО',
        self::ID_ECERS => 'ECERS'
    ];
    const DIRECTION_LIST =[
        self::ID_NOKDO => self::NOKDO,
        self::ID_ECERS => self::ECERS
    ];


    const NOKDO = 'NOKDO';
    const ECERS = 'ECERS';

    const ID_NOKDO = 1;
    const ID_ECERS = 2;

    const TABLE = 'directions';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Вывести уровень
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany| Level
     */
    public function levels()
    {
        return $this->hasMany(Level::class,'direction_id');
    }

    /**
     * @param $name
     * @return int
     * @throws \Exception
     */
    public static function getIdForName(string $name): int
    {
        switch ($name) {
            case self::NOKDO:
                $result = self::ID_NOKDO;
                break;
            case self::ECERS:
                $result = self::ID_ECERS;
                break;
            default:
                throw new \Exception('not_found');
        }

        return $result;
    }

    /**
     * Уроки
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class,'direction_id');
    }

}
