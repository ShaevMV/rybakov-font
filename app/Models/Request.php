<?php

namespace App\Models;


/**
 * App\Models\Request
 *
 * @property int $id
 * @property int|null $user_id Пользователь
 * @property int|null $expert_id Назначенный эксперт
 * @property int $payment_subject статус оплаты
 * @property string $city Город
 * @property string $fio Фамилия, имя и отчество
 * @property string $phone Телефон
 * @property string $email Емейл
 * @property string|null $date_of_meeting Дата встречи
 * @property int $check Факт посещение оналайн лекции
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereCheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereDateOfMeeting($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereExpertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereFio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request wherePaymentSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereUserId($value)
 * @mixin \Eloquent
 * @property int|null $level_id Уровень
 * @property-read \App\Models\Level|null $levels
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereLevelId($value)
 * @property int|null $group_request_id группа заявок
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereGroupRequestId($value)
 * @property-read \App\Models\GroupRequests|null $group_requests
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereDeletedAt($value)
 */
class Request extends Model
{
    /**
     * @var int номер уровня
     */
    const LEVEL_NUMBER = 2;
    /**
     * @var int номер этапа
     */
    const STAGE_NUMBER = 1;

    const TABLE = 'requests';
    /**
     * @var array
     */
    protected $fillable = [
        'expert_id',
        'user_id',
        'payment_subject',
        'city',
        'fio',
        'phone',
        'email',
        'date_of_meeting',
        'check',
        'level_id'
    ];

    /**
     * Уровень
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function levels()
    {
        return $this->belongsTo(Level::class,'level_id');
    }

    public function group_requests()
    {
        return $this->belongsTo(GroupRequests::class,'group_request_id');
    }
}
