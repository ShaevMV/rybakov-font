<?php

namespace App\Models;



/**
 * App\Models\MoreDetails
 *
 * @property int $id
 * @property int|null $level_id Уровень
 * @property string|null $text Текст для всплывающего окна
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Level|null $levels
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoreDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoreDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoreDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoreDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoreDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoreDetails whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoreDetails whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MoreDetails whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MoreDetails extends Model
{
    const TABLE = "more_details";

    protected $fillable = ['text', 'level_id'];

    public function levels()
    {
        return $this->belongsTo(Level::class,'level_id');
    }
}
