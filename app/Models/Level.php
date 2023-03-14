<?php

namespace App\Models;


/**
 * App\Models\Level
 *
 * @property int $id
 * @property int|null $direction_id направления
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stage[] $stages
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level whereDirectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $name Название уровня
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level whereName($value)
 * @property int $number Номер уровня
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level whereNumber($value)
 * @property-read \App\Models\Direction|null $directions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Testing[] $testings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Certificate[] $certificates
 */
class Level extends Model
{
    const TABLE = 'levels';

    protected $fillable = ['number','direction_id'];



    /**
     * Тесты
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|Testing
     */
    public function testings()
    {
        return $this->hasOne(Testing::class,'level_id');
    }


    /**
     * Этапы
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo| Direction
     */
    public function directions()
    {
        return $this->belongsTo(Direction::class, 'direction_id');
    }

    /**
     * Сертификат
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class,'level_id');
    }

    /**
     * Этапы
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stages()
    {
        return $this->hasMany(Stage::class,'level_id');
    }

    /**
     * Детальная информация
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function more_details()
    {
        return $this->hasOne(MoreDetails::class,'level_id');
    }
}
