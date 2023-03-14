<?php

namespace App\Container\Lesson;


use App\Models\Lesson;
use App\Models\Task;
use App\Models\TaskSelect;
use App\Models\Training;
use App\User;

class LessonAbstract
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var int
     */
    protected $directionId;


    /**
     * @var Training
     */
    protected $training;

    /**
     * @var int
     */
    protected $lessonSort;

    /**
     * Container constructor.
     *
     * @param User $user Пользователь
     * @param int $directionId направления
     * @param int|null $selectTaskId
     * @param int|null $lessonSort
     */
    public function __construct(User $user, int $directionId = 0, ?int $lessonSort = null)
    {
        $this->user = $user;
        $this->directionId = $directionId;
        $this->lessonSort = $lessonSort;
    }

    /**
     * @param int $lessonSort
     */
    public function setLessonSort(int $lessonSort): void
    {
        $this->lessonSort = $lessonSort;
    }




    /**
     * Выделить выбранную задачу
     *
     * @return bool|\Illuminate\Database\Eloquent\Model|null|object|static
     */
    protected function setSelectTask(int $taskId)
    {
        $taskSelect = TaskSelect::firstOrCreate($this->getArrayForSelectTask());
        $taskSelect->task_id = $taskId;
        return $taskSelect->save() ?
            Task::whereId($taskId)->first() : false;
    }

    protected function getArrayForSelectTask(): array
    {
        return [
            'user_id' => $this->user->id,
            'direction_id' => $this->directionId,
        ];
    }

    /**
     * @return Lesson|\Illuminate\Database\Eloquent\Builder|mixed
     */
    public function getModel()
    {
        return Lesson::whereDirectionId($this->directionId);
    }

    /**
     * Выдать последнее выбранныое задание
     *
     * @return TaskSelect|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function getLastSelectTask()
    {
        return TaskSelect::where($this->getArrayForSelectTask())->first();
    }

}