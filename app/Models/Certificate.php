<?php

namespace App\Models;


/**
 * App\Models\Certificate
 *
 * @property int $id
 * @property string $pdf
 * @property int $training_id Обучение
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate wherePdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereTrainingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id пользователь
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereUserId($value)
 * @property string $image ссылка на картинку
 * @property string $title название сертификата
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereTitle($value)
 * @property int $level_id уровень
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereLevelId($value)
 * @property int $stage_id этап
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereStageId($value)
 */
class Certificate extends Model
{
    const TABLE = 'certificates';

    /**
     * @var array
     */
    protected $fillable = ['pdf', 'title', 'user_id','stage_id'];
}
