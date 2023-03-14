<?php

namespace App\Models;


/**
 * App\Models\AnswerUsers
 *
 * @property int $id
 * @property int|null $question_id Вопросы
 * @property int|null $training_id Обучение
 * @property int|null $user_id Пользователь
 * @property string|null $answer Ответ
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Question|null $questions
 * @property-read \App\Models\Training|null $trainings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereTrainingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereUserId($value)
 * @mixin \Eloquent
 */
class AnswerUsers extends Model
{
    /**
     * @var string таблица
     */
    const TABLE = 'answer_user';

    protected $fillable = ['question_id', 'user_id', 'answer', 'training_id'];

    /**
     * Вопросы
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function questions()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    /**
     * Обучение
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trainings()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }
}
