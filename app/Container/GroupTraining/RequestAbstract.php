<?php

namespace App\Container\GroupTraining;


use App\Models\Request;
use App\Models\Level;
use App\User;
use Illuminate\Database\Eloquent\Collection;

abstract class RequestAbstract
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var Level направления
     */
    protected $level;

    /**
     * @var Request
     */
    protected $groupTrainingModel;

    /**
     * GroupTrainingAbstract constructor.
     * @param $user
     * @param Level $level
     * @throws \Exception
     */
    public function __construct($user, Level $level)
    {
        $this->user = $user;
        $this->level = $level;
        if ($this->getGroupTrainingModel()->exists()) {
            $this->groupTrainingModel = $this->getGroupTrainingModel();
        } else {
            throw new \Exception('Заявка не найдена !!!');
        }

    }

    /**
     * @return $this|Request|\Illuminate\Database\Eloquent\Builder
     */
    public function getGroupTrainingModel()
    {
        if ($this->groupTrainingModel) {
            return $this->groupTrainingModel
                ->with(Level::TABLE);
        }

        $groupTraining = Request::where(Request::TABLE . '.level_id', '=', $this->level->id);

        if ($this->user instanceof Collection) {
            $groupTraining->whereIntegerInRaw(Request::TABLE . '.user_id', $this->getIdUser());
        } else {
            $groupTraining->where(Request::TABLE . '.user_id', '=', $this->user->id);
        }
        return $groupTraining;
    }


    /**
     * Вывести список id пользователей
     *
     * @return array
     */
    protected function getIdUser(): array
    {
        return array_column($this->user->toArray(), 'id');
    }

    /**
     * @param Request $groupTrainingModel
     */
    public function setGroupTrainingModel($groupTrainingModel): void
    {
        $this->groupTrainingModel = $groupTrainingModel;
    }

}