<?php

namespace App\Models;


/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $sort Порядок сортировки
 * @property string $name Название отзыва
 * @property string $image Путь к картинке
 * @property int $active Признак активности
 * @property string $description Отзыв
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Review extends Model
{
    const TABLE = 'reviews';
}
