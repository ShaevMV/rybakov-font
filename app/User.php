<?php

namespace App;


use App\Models\Certificate;
use App\Models\Organization;
use App\Models\Progress;
use App\Models\Role;
use App\Models\Training;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

//use Illuminate\Contracts\Auth\MustVerifyEmail;


/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $role_id Роль пользователя
 * @property string $phone телефон
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\Role $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $position должность
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePosition($value)
 * @property int|null $organization_id Детский сад
 * @property-read \App\Models\Organization|null $organizations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereOrganizationId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Progress[] $progress
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Certificate[] $certificates
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Training[] $trainings
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    const TABLE = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role_id','position'
        //'garden', 'address', 'organisation', 'position', 'type', 'worker', 'role', 'status', 'nokdo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','updated_at','email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Связь с ролью
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    /**
     * Проверка на эксперта
     *
     * @return bool
     */
    public function isExpert(): bool
    {
        return $this->role_id === Role::ID_EXPERT;
    }

    /**
     * Связь с организацией
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organizations()
    {
        return $this->belongsTo(Organization::class,'organization_id');
    }


    /**
     * Прогресс обучения
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany| Progress
     */
    public function progress()
    {
        return $this->hasMany(Progress::class,'user_id');
    }


    /**
     * Сертификаты
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class,'user_id');
    }

    /**
     * Проверка на админа
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->roles->name == Role::ADMIN_TYPE;
    }

    /**
     * Обучение
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trainings()
    {
        return $this->hasMany(Training::class,'training_id');
    }
}
