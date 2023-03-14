<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\GroupRequests
 *
 * @property int $id
 * @property int|null $expert_id Назначенный эксперт
 * @property int|null $level_id Уровень
 * @property string|null $name Название группы
 * @property string|null $date_of_meeting Дата встречи
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task insertOnDuplicateKey($key)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereDateOfMeeting($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereExpertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $place место провидения
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Level|null $levels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Request[] $requests
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GroupRequests onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests wherePlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GroupRequests withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GroupRequests withoutTrashed()
 */
class GroupRequests extends Model
{
    const TABLE = 'group_requests';
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['expert_id', 'level_id', 'date_of_meeting', 'name'];


    /**
     * Заявки
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requests()
    {
        return $this->hasMany(Request::class,'group_request_id');
    }

    /**
     * Уровни
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function levels()
    {
        return $this->belongsTo(Level::class,'level_id');
    }
}
