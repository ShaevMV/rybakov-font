<?php

namespace App\Models;

use App\User;


/**
 * App\Models\TaskSelect
 *
 * @property int $id
 * @property int $user_id пользователь
 * @property int $task_id задача
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect whereUserId($value)
 * @mixin \Eloquent
 * @property int|null $direction_id направление
 * @property-read \App\Models\Task $tasks
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect whereDirectionId($value)
 */
class TaskSelect extends Model
{
    const TABLE = 'task_select';

    protected $fillable = ['task_id', 'user_id', 'direction_id'];

    /**
     * Пользователь
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * задача
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tasks()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }



}
