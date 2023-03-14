<?php

namespace App\Models;
use Illuminate\Database\Query\JoinClause;


/**
 * App\Models\Progress
 *
 * @property int $id
 * @property int $user_id пользователь
 * @property int $level_id Доступный уровень
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Level $levels
 * @property int $stage_id Доступный этап
 * @property-read \App\Models\Stage $stages
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress whereStageId($value)
 */
class Progress extends Model
{
    const TABLE = 'progress';

    protected $fillable = ['user_id', 'stage_id'];

    /**
     * Этап
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stages()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    /**
     * Уровень
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function levels()
    {
        return $this->hasOneThrough(Level::class,Stage::class,'id','id','stage_id');
    }

    /**
     * Вывести доступные уровни по определённому направлению для определённого пользователя
     *
     * @param int $directionId
     * @param int $userId
     * @return $this
     */
    public function listLevels()
    {
        return $this->leftJoin(Stage::TABLE, Progress::TABLE . '.stage_id', '=', Stage::TABLE . '.id')
            ->join(Level::TABLE, function (JoinClause $join) {
                $join->on(Level::TABLE . '.id', '=', Stage::TABLE . '.level_id');
                    //->where(Level::TABLE . '.direction_id', '=', $directionId);
            });
            //->where(Progress::TABLE. '.user_id', '=', $userId)
    }
}
