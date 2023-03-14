<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property int|null $direction_id направления
 * @property string $title название урока
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Direction|null $directions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereDirectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson withoutTrashed()
 * @property int|null $sort
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereSort($value)
 */
class Lesson extends Model
{
    use SoftDeletes;

    const TABLE = 'lessons';

    protected $fillable = ['title','direction_id'];
    /**
     * @var int Номер уровня для онлайн обучения
     */
    const NUMBER_LEVEL = 1;
    /**
     * @var int Номер этапа для онлайн обучения
     */
    const NUMBER_STAGE = 1;

    /**
     * Напровление
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function directions()
    {
        return $this->belongsTo(Direction::class,'direction_id');
    }


    /**
     * Задачи
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class,'lesson_id');
    }
}
