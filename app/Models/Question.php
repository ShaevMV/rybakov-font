<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Question
 *
 * @property int $id
 * @property int|null $testing_id тестирования
 * @property string $text текст вопроса
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Testing|null $testings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereTestingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\AnswerOptions $answerOptions
 * @property-read \App\Models\AnswerOptions $answer_options
 * @property-read \App\Models\AnswerUsers $answer_user
 * @property string $type Тип вопроса
 * @property mixed|null $options Варианты ответов
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $morphtable_type связаная таблица
 * @property int|null $morphtable_id связаная сущность
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $morphtable
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereMorphtableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereMorphtableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question withoutTrashed()
 * @property string|null $comment
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereComment($value)
 */
class Question extends Model
{
    use SoftDeletes;

    const TABLE = 'questions';
    /**
     * @var array Типы вариантов ответа
     */
    const TYPE_ANSWER_OPTIONS = [
        self::QUESTION_OPTION_TYPE,
        self::QUESTION_TEXT_TYPE,
        self::QUESTION_MANY_TYPE
    ];
    const QUESTION_OPTION_TYPE = 'option';
    const QUESTION_TEXT_TYPE = 'text';
    const QUESTION_MANY_TYPE = 'many';
    /**
     * @var string цифровой вариант ответа
     */
    const TESTING = 'testing';
    /**
     * @var int Количество вариантов ответа
     */
    const COUNT_OPTION = 4;
    /**
     * @var int Количество вариантов ответа в NOKDO
     */
    const COUNT_NOKDO = 4;
    /**
     * @var int Количество вариантов ответа в ECERS
     */
    const COUNT_ECERS = 7;

    /**
     * @var string тип в json массиве
     */
    const TYPE_BY_OPTIONS = 'type';
    /**
     * @var string Варианты ответа в json массиве
     */
    const TYPE_BY_ANSWER = 'answer';

    /**
     * @var string Показатель правильности ответа
     */
    const TYPE_BY_RIGHT = 'right';

    protected $fillable = ['text','options','type','comment'];

    /**
     * Получить все модели, обладающие morphtable.
     */
    public function morphtable()
    {
        return $this->morphTo();
    }


    /**
     * Ответы
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function answer_user()
    {
        return $this->hasOne(AnswerUsers::class,'question_id');
    }
}
