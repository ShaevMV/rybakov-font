<?php

namespace App\Models;


/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name тип роли
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    /**
     * Типы ролей
     */
    const ROLES_TYPE = [
        self::ADMIN_TYPE,
        self::USER_TYPE,
        self::KINDERGARTEN_TYPE,
        self::EXPERT_TYPE
    ];

    const ID_ADMIN = 1;
    const ID_USER = 2;
    const ID_KINDERGARTEN = 3;
    const ID_EXPERT = 4;



    const ADMIN_TYPE = 'admin';
    const USER_TYPE = 'user';
    const KINDERGARTEN_TYPE = 'kindergarten';
    const EXPERT_TYPE = 'expert';

    const TABLE = 'roles';
}
