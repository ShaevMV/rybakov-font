<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;


/**
 * App\Models\ModelWidget
 *
 * @property int $id
 * @property string $title Заголовок
 * @property int $ordering Порядок отображения
 * @property int $active Активность
 * @property string $template Шаблон
 * @property mixed $params
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereTitle($value)
 * @mixin \Eloquent
 * @property int $sort Порядок отображения
 * @property string $join_data Подключаемые данные
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereJoinData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereSort($value)
 * @property string $data_join Присоединенные данные
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereDataJoin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereUpdatedAt($value)
 */
class Widget extends Model
{
    const TABLE = 'widgets';
    protected $fillable = ['title', 'ordering', 'active', 'params', 'template', 'sort'];

    /**
     * Получить все активные Виджеты
     *
     * @return Collection[]|null
     */
    public function getActiveList(): ?Collection
    {
        return $this->whereActive(true)
            ->orderBy('sort', 'asc')
            ->get();
    }

    /**
     * Получить значения определённых свойствх определённого виджета
     *
     * @param $param
     * @return array
     */
    public function getArValueParam($param): array
    {
        return json_decode($this->params)[$param] ?? [];
    }

    /**
     * Получить значение определённых свойств определённого виджета
     *
     * @param $param
     * @return array
     */
    public function getValueParam($param): ?string
    {
        return json_decode($this->params)[$param] ?? null;
    }
}
