<?php

namespace App\Container\Lesson;


use App\Container\Testing\Trainings;
use App\Models\AnswerUsers;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Task;
use App\Models\Training;
use Illuminate\Database\Query\JoinClause;

class LessonTesting extends Trainings
{
    /**
     * @var string
     */
    protected $classModel = Task::class;

    /**
     * Проверить на выполнение все тестовые задания за предыдущие уроки
     *
     * @param int $lessonSort
     * @param int $directionId
     * @param int $userId
     * @return bool|mixed|static
     */
    public static function getTaskQuestionsNotAnswered(int $lessonSort, int $directionId, int $userId)
    {
        $lesson = (new Lesson)->where(Lesson::TABLE . '.sort', '<', $lessonSort)
            ->where(Lesson::TABLE . '.direction_id', '=', $directionId)
            ->whereNull(AnswerUsers::TABLE . '.id')
            ->leftJoin(Task::TABLE, function (JoinClause $join) {
                $join->on(Lesson::TABLE . '.id', '=', Task::TABLE . '.lesson_id')
                    ->where(Task::TABLE . '.type', '=', Question::TESTING);
            })
            ->leftJoin(Question::TABLE, function (JoinClause $join) {
                $join->on(Question::TABLE . '.morphtable_id', '=', Task::TABLE . '.id')
                    ->where(Question::TABLE . '.morphtable_type', 'like', '%Task%');
            })
            ->leftJoin(Training::TABLE, function (JoinClause $join) use ($userId) {
                $join->on(Training::TABLE . '.morphtable_id', '=', Task::TABLE . '.id')
                    ->where(Training::TABLE . '.morphtable_type', 'like', '%Task%')
                    ->where(Training::TABLE . '.user_id', '=', $userId)
                    ->where(Training::TABLE . '.passed', '=', 0);
            })
            ->leftJoin(AnswerUsers::TABLE, function (JoinClause $join) {
                $join->on(AnswerUsers::TABLE . '.training_id', '=', Training::TABLE . '.id')
                    ->on(AnswerUsers::TABLE . '.question_id', '=', Question::TABLE . '.id');
            })
            ->selectRaw(Task::TABLE.'.*')
            ->first();

        return !empty($lesson->id) ? (new Task)->find($lesson->id) : false;
    }

    /**
     * Закрыть все тестовые задания в онлайн обучении по определённому обучению
     *
     * @param int $directionId
     * @param int $userId
     * @return int
     */
    public static function completeAllTraining(int $directionId, int $userId)
    {
        return Training::where(Training::TABLE . '.user_id', '=', $userId)
            ->where(Training::TABLE . '.passed', '=', 0)
            ->where(Training::TABLE . '.morphtable_type', '=', Task::class)
            ->leftJoin(Task::TABLE, function (JoinClause $join){
                $join->on(Task::TABLE . '.id', '=', Training::TABLE . '.morphtable_id');
            })
            ->leftJoin(Lesson::TABLE, function (JoinClause $join) use ($directionId){
                $join->on(Lesson::TABLE . '.id', '=', Task::TABLE . '.lesson_id')
                    ->where(Lesson::TABLE . '.direction_id', '=', $directionId);
            })
            ->update([
                Training::TABLE.'.passed' => true
            ]);
    }
}