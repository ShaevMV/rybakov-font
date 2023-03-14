<?php

namespace App\Http\Controllers\Api\v1;


use App\Container\Certificates\CertificatesCreate;
use App\Container\Lesson\LessonContainer;
use App\Container\Lesson\LessonTesting;
use App\Container\Notification\NotificationContainer;
use App\Container\Progress\ProgressContainer;
use App\Container\UserMessage\MessageLesson;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Direction;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Task;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Перейти к заданию
     *
     * @param string $type
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function selectTask(string $type, Request $request)
    {
        /** @var LessonContainer $lesson */
        $lesson = Container::getInstance()->make(LessonContainer::class,[
            'user' => \Auth::user(),
            'directionId' => Direction::getIdForName($type),
            'lessonSort' => $request->get('lessonSort'),
        ]);
        $lessonList = $lesson->getList();
        if(count($lessonList)>0){
            $selectTask = $lesson->selectTask($request->get('taskId')) ?? $lessonList->first()->tasks->first();
        } else {
            $selectTask = [];
        }
        return response()->json([
            'listLesson' => $lessonList,
            'selectTask' => $selectTask,
            'questions' => $lesson->getQuestionsForTask(),
        ], is_object($lesson->isQuestionsAnswered()) ? 420 : 200);
    }

    /**
     * Завершение урока с генерацией сертификата и переходом на 2-й уровень
     *
     * @param string $type
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function endLesson(string $type,Request $request)
    {
        /** @var LessonContainer $lesson */
        $lesson = Container::getInstance()->make(LessonContainer::class,[
            'user' => \Auth::user(),
            'directionId' => Direction::getIdForName($type),
            'lessonSort' => $request->get('lessonSort')
        ]);
        $task = $lesson->getLastSelectTask()->tasks ?? null;
        if((new LessonTesting(
                \Auth::user(),
            $task))->checkAllQuestionsAnswered() === 0){
                ProgressContainer::complete($lesson);
                $lesson->complete();
                LessonTesting::completeAllTraining(Direction::getIdForName($type), \Auth::id());
                $certificate = new CertificatesCreate($lesson);
                if($certificate->saveToTable()){
                    $certificate->createPdf();
                }

                $message = new MessageLesson($lesson);
                NotificationContainer::send(\Auth::user(), $message->getModalMessage());
                return response()->json([
                    'message' => $lesson->getMessage()
                ], 200);
        } else {
            return response()->json('Error!!!', 420);
        }

    }

    /**
     * Создание урока
     *
     * @param LessonRequest $request
     * @return $this|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function store(LessonRequest $request)
    {
        return Lesson::create([
            'title' => $request->get('title'),
            'direction_id' => Direction::getIdForName($request->get('type')),
        ]);
    }

    /**
     * Обновление урока + создание задач в уроке
     *
     * @param $lessonId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $lessonId,Request $request)
    {
        Lesson::findOrFail($lessonId)->update([
            'title' => $request->get('lesson')['title'],
            'sort' => $request->get('lesson')['sort']
        ]);
        Task::whereLessonId($lessonId)->delete();
        Task::insertOnDuplicateKey($request->get('tasks'));
        return response()->json('OK!!!', 200);
    }

    /**
     * удалить урок
     *
     * @param int $lessonId
     * @return bool|null
     * @throws \Exception
     */
    public function remove(int $lessonId)
    {
        return response()->json([
            "remove" =>Lesson::findOrFail($lessonId)->delete()
        ]);
    }

    /**
     * загрузить данные урока
     *
     * @param int $lessonId
     * @return bool|null
     * @throws \Exception
     */
    public function getLesson(int $lessonId)
    {
        $result = Lesson::whereId($lessonId)->with(Task::TABLE);
        return response()->json($result->first());
    }

    /**
     * загрузить данные задания
     *
     * @param int $lessonId
     * @return bool|null
     * @throws \Exception
     */
    public function getTask(int $taskId)
    {
        $result = Task::whereId($taskId)->with(Question::TABLE);
        return response()->json($result->first());
    }

    /**
     * Добавить задачу к уроку
     *
     * @param TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addTask(TaskRequest $request)
    {
        if($request->get('id')){
            Task::whereId($request->get('id'))
                ->update($request->all());
        } else {
            Task::updateOrCreate($request->all());
        }

        return response()->json('OK!!!!');
    }

    /**
     * @param int $questionId
     * @param Request $request
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setAnswer(int $questionId, Request $request)
    {
        $task = Question::findOrFail($questionId)->morphtable;
        $lessonTesting = new LessonTesting(
            \Auth::user(),
            $task);
        $lessonTesting->setType($request->get('type'));
        $result = $lessonTesting->setAnswer($questionId, $request->get('answer'));
        return response()->json(['answer' => $result]);
    }
}
