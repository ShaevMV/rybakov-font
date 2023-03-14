<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property int|null $lesson_id урок
 * @property string $type тип текста или видео
 * @property string $title название задания
 * @property string $content содержание
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lesson|null $lessons
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task insertOnDuplicateKey($key)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $description Описание
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereDescription($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TaskSelect[] $selectTasks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task withoutTrashed()
 */
class Task extends Model
{
    use SoftDeletes;
    const TABLE = 'tasks';

    protected $fillable = ['type','content','lesson_id','description','title'];

    /**
     * Урок
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lessons()
    {
        return $this->belongsTo(Lesson::class,'lesson_id');
    }

    /**
     * Выбраная задача
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function selectTasks()
    {
        return $this->hasMany(TaskSelect::class,'task_id');
    }

    /**
     * Вопросы
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function questions()
    {
        return $this->morphMany(Question::class,'morphtable');
    }
}
