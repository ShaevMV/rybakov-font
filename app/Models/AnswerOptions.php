<?php

namespace App\Models;


/**
 * App\Models\AnswerOptions
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $question_id Вопрос
 * @property mixed|null $options Варианты ответа
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions whereUpdatedAt($value)
 */
class AnswerOptions extends Model
{
    /**
     * @var string таблица
     */
    const TABLE = 'answer_options';

    /**
     * @var array Типы вариантов ответов
     */
    const TYPE_ANSWER_OPTIONS = [
        self::OPTION,
        self::TEXT
    ];
    /**
     * @var string Варианты ответа
     */
    const OPTION = 'option';
    /**
     * @var string Письменный вариант ответа
     */
    const TEXT = 'text';
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
    const COUNT_NOKDO = 3;
    /**
     * @var int Количество вариантов ответа в ECERS
     */
    const COUNT_ECERS = 7;

    /**
     * @var string тип в json массиве
     */
    const TYPE_BY_OPTIONS = 'type';
    /**
     * @var string Варианты ответов в json массиве
     */
    const TYPE_BY_ANSWER = 'answer';

    /**
     * @var string Показатель правильности ответа
     */
    const TYPE_BY_RIGHT = 'right';

    /**
     * @var array
     */
    protected $fillable = ['options', 'question_id'];

    /**
     * Вопросы
     */
    public function questions()
    {
        $this->belongsTo(Question::class, 'question_id');
    }
}
