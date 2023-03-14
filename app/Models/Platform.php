<?php

namespace App\Models;


/**
 * App\Models\Platform
 *
 * @property int $id
 * @property string $title название платформы
 * @property string $link ссылка на платформу
 * @property int $active статус активности
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Platform extends Model
{
    const TABLE = 'platforms';
    protected $fillable = ['title', 'link', 'active'];
}
