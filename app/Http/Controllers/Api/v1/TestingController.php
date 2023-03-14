<?php

namespace App\Http\Controllers\Api\v1;

use App\Container\Certificates\CertificatesCreate;
use App\Container\Level\LevelContainer;
use App\Container\Notification\NotificationContainer;
use App\Container\Progress\ProgressContainer;
use App\Container\Testing\Question\QuestionModel;
use App\Container\Testing\TestingContainer;
use App\Container\Testing\TrainingsContainer;
use App\Container\UserMessage\MessageEndTesting;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestQuestions;
use App\Jobs\PushTestingInEmailJob;
use App\Models\AnswerOptions;
use App\Models\Direction;
use App\Models\Question;
use App\Models\Task;
use App\Models\Testing;
use App\Models\Training;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Вывести список вопросов у теста
     *
     * @param string $type
     * @param int $level
     * @param int $page
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getListQuestions(string $type, int $level, int $page)
    {
        $directionId = Direction::getIdForName($type);
        $level = LevelContainer::getLevelByNumber($level, $directionId);
        $testing = (new TestingContainer($level))->getTesting();

        /** @var TrainingsContainer $trainings */
        $trainings = Container::getInstance()
            ->make(TrainingsContainer::class, [
                'user' => \Auth::user(),
                'model' => $testing
            ]);
        return response()->json([
            'questions' => $trainings->getList()
                ->paginate(Testing::PAGINATE_COUNT, ['*'], 'page', $page)
                ->toArray(),
            'testing' => $testing,
            'directionName' => Direction::DIRECTION_LIST_RUS[$directionId],
        ]);
    }

    /**
     * Загрузить пользовательские ответы
     *
     * @param int $trainingId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function loadUserAnswer(int $trainingId)
    {
        $trainingModel = Training::findOrFail($trainingId);
        $testing = $trainingModel->morphtable;
        $trainings = Container::getInstance()
            ->make(TrainingsContainer::class, [
                'user' => $trainingModel->users,
                'model' => $testing,
                'training' => $trainingModel
            ]);
        return response()->json([
            'questions' => $trainings->getList()->get(),
            'testing' => $testing,
            'training' => $trainingModel,
            'directionName' => Direction::DIRECTION_LIST_RUS[$testing->level->direction_id],
        ]);
    }

    /**
     * Записать ответ на вопрос
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setAnswerOptions(Request $request)
    {
        /** @var TrainingsContainer $answer */
        $answer = Container::getInstance()
            ->make(TrainingsContainer::class, [
                'user' => \Auth::user(),
                'model' => Testing::findOrFail($request->get('testId'))
            ]);
        $answer->setType($request->get('type'));

        return response()->json([
            'answer' => $answer->setAnswer($request->get('idQuestions'),
                $request->get('answer')
            ),
        ]);
    }


    /**
     * Проверка того, что тест отвечен на все вопросы
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function submitTesting(Request $request)
    {
        $testing = Testing::findOrFail($request->get('testId'));
        /** @var TrainingsContainer $training */
        $training = $answer = Container::getInstance()
            ->make(TrainingsContainer::class, [
                'user' => \Auth::user(),
                'model' => $testing
            ]);

        $checkAll = $training->checkAllQuestionsAnswered();
        if ($checkAll === 0) {
            $training->complete();
            if ($testing->auto_complete) {
                ProgressContainer::complete($training);
                $certificate = new CertificatesCreate($training);
                if($certificate->saveToTable()){
                    $certificate->createPdf();
                }
                /*dispatch((new CreateCertificate(
                    $training
                ))->onConnection('database')
                    ->delay(5));*/
            }
            $message = new MessageEndTesting($training);
            NotificationContainer::send(Auth::user(), $message->getModalMessage());
            return response()->json([
                'message' => $message->getModalMessage()
            ]);
        } else {
            return response()->json(['countNotAnswered' => $checkAll], 420);
        }
    }

    /**
     * Удаление вопроса
     *
     * @param int $questionsId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function remove(int $questionsId)
    {
        Question::findOrFail($questionsId)->delete();
        return response()->json('OK!!!');
    }

    /**
     * Обновление данных о тесте
     *
     * @param int $testingId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $testingId, Request $request)
    {
        $request->validate([
            'description' => 'required'
        ]);
        Testing::findOrFail($testingId)->update($request->all());
        return response()->json('OK!!!');
    }

    /**
     * Записать вопрос в тестирование или к заданию урока
     *
     * @param string $typeTesting
     * @param int $id
     * @param RequestQuestions $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveQuestions(string $typeTesting, int $id, RequestQuestions $request)
    {
        $data = $request->get('data');
        $model = new QuestionModel(isset($data['id']) ? $data['id'] : 0);

        $options = $data['type'] === AnswerOptions::TESTING ?
            QuestionModel::getOptionsForTesting($request->get('typeQuestion')) : $data['options'];
        $model->save($data, $options);

        switch ($typeTesting) {
            case 'test':
            case 'testing':
                Testing::findOrFail($id)
                    ->questions()
                    ->save($model->getModel());
                break;
            case 'task':
                Task::find($id)
                    ->questions()
                    ->save($model->getModel());
        }
        return response()->json($model->getModel());
    }

    /**
     * Отправка на емйал результатов тестирования
     *
     * @param string $type
     * @param int $idTesting
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function pushInEmail(string $type, int $idTesting)
    {
        $training = Container::getInstance()
            ->make(TrainingsContainer::class, [
                'user' => \Auth::user(),
                'model' => Testing::find($idTesting)
            ]);

        if($training->checkAllQuestionsAnswered() === 0){
            // отправка письма
            dispatch((new PushTestingInEmailJob(
                $type,
                $idTesting,
                \Auth::id()
            ))->onConnection('database')
                ->delay(5));

            ProgressContainer::complete($training);
            $certificate = new CertificatesCreate($training);
            if($certificate->saveToTable()){
                $certificate->createPdf();
            }

            $message = new MessageEndTesting($training);
            NotificationContainer::send(\Auth::user(), $message->getModalMessage());
            $idDirection = Direction::getIdForName($type);
            return response()->json([
                'message' => "<span class='uk-text-bold'> Поздравляем!</span> Вы прошли самооценку с использованием инструмента оценки качества дошкольного 
                    образования ".Direction::DIRECTION_LIST_RUS[$idDirection].". Результаты самооценки отправлы на Ваш e-mail. 
                    Сертификат Мастера самооценки уже в Вашем личном кабинете. Приглашаем Вас принять участие 
                    во втором этапе обучения – очном семинаре «Исследователь качества». Подайте заявку уже сегодня!"
            ], 200);
        } else {
            return response()->json([
                'error' => 'Для завершения теста ответьте на оставшиеся вопросы'
            ], 420);
        }

    }

    /**
     * Проверка что в тесте отвечены все вопросы
     *
     * @param int $idTesting
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function validUserAnswer(int $idTesting)
    {
        $trainings = Container::getInstance()
            ->make(TrainingsContainer::class, [
                'user' => \Auth::user(),
                'model' => Testing::find($idTesting)
            ]);
        return response()->json('OK!!!',
            $trainings->checkAllQuestionsAnswered() === 0 ? 200 : 420);
    }

}
