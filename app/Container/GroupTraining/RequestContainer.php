<?php

namespace App\Container\GroupTraining;

use App\Container\InterfaceStage;
use App\Models\Level;
use App\Models\Request;
use App\Models\Role;
use App\Models\Stage;
use App\User;
use Illuminate\Database\Query\JoinClause;

class RequestContainer extends RequestAbstract implements InterfaceStage
{
    /**
     * Создать заявку от пользователя
     *
     * @param $param
     * @return $this|\Illuminate\Database\Eloquent\Model|Request
     */
    public static function setGroupTraining($param)
    {
        return Request::updateOrCreate($param);
    }

    /**
     * Присвоить статус оплаты
     *
     * @param bool $status
     * @return bool
     */
    public function pay(bool $status): bool
    {
        return $this->groupTrainingModel
                ->update(['payment_subject' => $status]) > 0;
    }

    /**
     * Установка флага о проведении обучения
     *
     * @return bool
     */
    public function complete(): bool
    {
        return $this->groupTrainingModel->update([
                'check' => true
            ]) > 0;
    }

    /**
     * Вывести список пользователей
     *
     * @return User|\Illuminate\Database\Eloquent\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Вывести этап
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object
     */
    public function getStage()
    {
        return Stage::where('level_id', '=', $this->level->id)
            ->where('number', '=', Request::STAGE_NUMBER)
            ->first();
    }

    /**
     * Вывести список заявок пользователей по определённому уровню
     *
     * @param Level $level
     * @return $this|\Illuminate\Database\Query\Builder
     */
    public static function getListUser(Level $level)
    {
        return Request::where(Request::TABLE . '.level_id', '=', $level->id)
            ->crossJoin(User::TABLE, function (JoinClause $join) {
                $join->on(Request::TABLE . '.user_id', '=', User::TABLE . '.id')
                    ->where(User::TABLE . '.role_id', '<>', Role::ID_KINDERGARTEN);
            })->select([
                Request::TABLE . '.*'
            ]);
    }

    /**
     * Вывести заявки детских садов
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public static function getListKindergarten()
    {
        return (new Request())->crossJoin(User::TABLE, function (JoinClause $join) {
            $join->on(Request::TABLE . '.user_id', '=', User::TABLE . '.id')
                ->where(User::TABLE . '.role_id', '=', Role::ID_KINDERGARTEN);
        })->select([
            Request::TABLE . '.*'
        ]);
    }

    public static function updateList(array $updateList)
    {
        return Request::insertOnDuplicateKey($updateList);
    }

    /**
     * Дать доступ к прохождению теста
     *
     * @param int $id
     * @return Request|static|static[]
     */
    public static function checkRequest(int $id)
    {
        $result = Request::findOrFail($id);
        $result->update([
            'check' => true
        ]);
        return $result;
    }


    /**
     * Вывести список заявок которые подходят к отправки уведомлений
     *
     * @param array $requestList
     * @return array
     */
    public static function getRequestListForNutification(array $requestList): array
    {
        $result = [];
        foreach ($requestList as $item) {
            if ($item['group_request_id']) {
                $result[] = $item;
            }
        }
        return $result;
    }

}