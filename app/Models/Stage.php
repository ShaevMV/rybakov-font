<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;


/**
 * App\Models\Stage
 *
 * @property int $id
 * @property int|null $level_id уровень
 * @method static Builder|\App\Models\Stage newModelQuery()
 * @method static Builder|\App\Models\Stage newQuery()
 * @method static Builder|\App\Models\Stage query()
 * @method static Builder|\App\Models\Stage whereId($value)
 * @method static Builder|\App\Models\Stage whereLevelId($value)
 * @mixin \Eloquent
 * @property string $name Название этапа
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|\App\Models\Stage whereCreatedAt($value)
 * @method static Builder|\App\Models\Stage whereName($value)
 * @method static Builder|\App\Models\Stage whereUpdatedAt($value)
 * @property int|null $testing_id тестирования
 * @property-read \App\Models\Testing|null $testings
 * @method static Builder|\App\Models\Stage whereTestingId($value)
 * @property int $number Номер этапа
 * @method static Builder|\App\Models\Stage whereNumber($value)
 * @property-read \App\Models\Level|null $levels
 */
class Stage extends Model
{
    const TABLE = 'stages';

    protected $fillable = ['number', 'level_id'];

    /**
     * Уровень
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function levels()
    {
        return $this->belongsTo(Level::class,'level_id');
    }

    /**
     * Вывести этап для уровня
     *
     * @param int $idDirection
     * @return \Illuminate\Database\Query\Builder|Stage
     */
    public static function getStageForLesson(int $idDirection)
    {
        return self::join(Level::TABLE, function (JoinClause $join) use ($idDirection) {
            $join->on(Stage::TABLE . '.level_id', '=', Level::TABLE . '.id')
                ->where(Level::TABLE . '.direction_id', '=', $idDirection)
                ->where(Level::TABLE . '.number', '=', Lesson::NUMBER_LEVEL);
        })->where(Stage::TABLE . '.number', '=', Lesson::NUMBER_STAGE)
            ->select([Stage::TABLE . '.*'])
            ->first();
    }

}
