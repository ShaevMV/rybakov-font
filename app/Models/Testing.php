<?php

namespace App\Models;


/**
 * App\Models\Testing
 *
 * @property int $id
 * @property int|null $stage_id Этап
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $active активность теста
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereActive($value)
 * @property int $auto_assessment Автопрохождение теста
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereAutoAssessment($value)
 * @property-read \App\Models\Stage|null $stages
 * @property int|null $level_id Уровень
 * @property string $description Описание
 * @property-read \App\Models\Level|null $level
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereLevelId($value)
 * @property string $type Тип тестирования (тест, тестирование)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Training[] $trainings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereType($value)
 * @property int $auto_complete автозавершение теста
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereAutoComplete($value)
 */
class Testing extends Model
{
    /**
     * @var int количество выводимых вопросов в тесте
     */
    const PAGINATE_COUNT = 10;

    const TABLE = 'testings';
    /**
     * @var string тип теста
     */
    const TYPE_TEST = 'test';
    /**
     * @var string тип тестирования
     */
    const TYPE_TESTING = 'testing';

    protected $fillable = ['description'];

    /**
     * Уровень
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo(Level::class,'level_id');
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

    /**
     * Образование
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trainings()
    {
        return $this->hasMany(Training::class,'testing_id');
    }
}
