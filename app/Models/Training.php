<?php

namespace App\Models;

use App\User;

/**
 * App\Models\Training
 *
 * @property int $id
 * @property int $direction_id Направление
 * @property int $user_id Пользователь
 * @property int $expert_id Эксперт
 * @property int $testing_id Тест
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereDirectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereExpertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereTestingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $expert_opinion Мнение эксперта
 * @property string|null $assessment Оценка
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Certificate[] $certificates
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereAssessment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereExpertOpinion($value)
 * @property-read \App\Models\Testing $testings
 * @property-read \App\User $users
 * @property int $passed пройден тест
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training wherePassed($value)
 * @property string|null $morphtable_type связаные таблицы
 * @property int|null $morphtable_id связаные таблицы
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereMorphtableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereMorphtableType($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Training[] $morphtable
 */
class Training extends Model
{
    const TABLE = 'trainings';
    protected $fillable = ['user_id','morphtable_type','morphtable_id','expert_id','expert_opinion','passed'];

    /**
     * Сертификаты
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * Тестирование
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function morphtable()
    {
        return $this->morphTo();
    }

    /**
     * Пользователь
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }


}
