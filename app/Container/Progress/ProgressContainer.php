<?php

namespace App\Container\Progress;


use App\Container\Container;
use App\Container\InterfaceStage;
use App\Models\Level;
use App\Models\Progress;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;


class ProgressContainer extends Container implements InterfaceComplete
{

    /**
     * Вывести модель
     *
     * @return $this|mixed
     */
    protected function getModel()
    {
        return $this->joinTable(Progress::whereUserId($this->user->id))
            ->select([
                Progress::TABLE . '.id',
                DB::raw(Level::TABLE . '.id as level_id'),
                DB::raw(Level::TABLE . '.number as level_number'),
                DB::raw(Stage::TABLE . '.id as stage_id'),
                DB::raw(Stage::TABLE . '.number as stage_number'),
            ]);

    }

    /**
     * Завершить этап
     *
     * @param InterfaceStage $interfaceStage
     * @param bool $isNotification
     * @return array|\Illuminate\Database\Eloquent\Model|static
     */
    public static function complete(InterfaceStage $interfaceStage)
    {
        if ($interfaceStage->getUser() instanceof Collection) {
            $result = self::completesManyUser($interfaceStage);
        } else {

            $result = Progress::updateOrCreate([
                'user_id' => $interfaceStage->getUser()->id,
                'stage_id' => $interfaceStage->getStage()->id
            ]);
        }


        return $result;
    }

    /**
     * Завершить этап у нескольких пользователей
     *
     * @param InterfaceStage $interfaceStage
     * @return bool
     */
    private static function completesManyUser(InterfaceStage $interfaceStage)
    {
        $data = [];
        foreach ($interfaceStage->getUser() as $item) {
            $data[] = [
                'user_id' => $item->id,
                'stage_id' => $interfaceStage->getStage()->id
            ];
        }
        return Progress::updateOrInsert($data);
    }


    /**
     * Вывести список доступных этапов и уровней
     *
     * @return Collection|static[]
     */
    public function getList()
    {
        return $this->storage->get();
    }


}