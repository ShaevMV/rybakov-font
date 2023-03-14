<?php

namespace App\Models;

use App\User;


/**
 * App\Models\Organization
 *
 * @property int $id
 * @property string $name Название детского сада
 * @property string $address Адрес детского сада
 * @property int $user_id Представитель
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereUserId($value)
 * @mixin \Eloquent
 * @property string $name_organization Название детского сада
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereNameOrganization($value)
 * @property float|null $width Ширина
 * @property float|null $long Длина
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereWidth($value)
 */
class Organization extends Model
{
    const TABLE = 'organizations';

    protected $fillable = ['name_organization', 'address'];

    /**
     * Связь с пользователем
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class,'organization_id');
    }
}
