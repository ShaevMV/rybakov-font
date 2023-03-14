<?php

namespace App\Http\Controllers\Api\v1;


use App\Container\Filter\Filter;
use App\Container\GroupTraining\RequestContainer;
use App\Container\GroupTraining\RequestGroupContainer;
use App\Container\Level\LevelContainer;
use App\Container\Notification\NotificationContainer;
use App\Container\Notification\NotificationMessageRequest;
use App\Container\Progress\ProgressContainer;
use App\Container\Testing\TrainingsContainer;
use App\Container\UserMessage\MessageRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupAddRequest;
use App\Models\Direction;
use App\Models\GroupRequests;
use App\Models\Level;
use App\Models\Role;
use App\Models\Testing;
use App\Models\Training;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Добавить заявку
     *
     * @param string $type
     * @param int $level
     * @param GroupAddRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function addRequest(string $type, int $level, GroupAddRequest $request)
    {
        $levelModel = LevelContainer::getLevelByNumber($level, Direction::getIdForName($type));
        RequestContainer::setGroupTraining([
            'user_id' => \Auth::id(),
            'city' => $request->get('city'),
            'level_id' => $levelModel->id,
            'fio' => $request->get('name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
        ])->with(Level::TABLE)
            ->first();
        $requestContainer = new RequestContainer(\Auth::user(), $levelModel);
        ProgressContainer::complete($requestContainer);

        $message = new MessageRequest($requestContainer);
        NotificationContainer::send(\Auth::user(), $message->getModalMessage());

        return response()->json([
            'message' => $message->getModalMessage()
        ]);
    }

    /**
     * Вывести данные о заявке
     *
     * @param string $type
     * @param int $level
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getRequest(string $type, int $level)
    {
        try {
            $groupTraining = new RequestContainer(\Auth::user(), LevelContainer::getLevelByNumber($level, Direction::getIdForName($type)));
            return response()
                ->json($groupTraining->getGroupTrainingModel()
                    ->with([
                        Level::TABLE,
                        GroupRequests::TABLE
                    ])
                    ->leftJoin(Testing::TABLE, function (JoinClause $join) {
                        $join->on(\App\Models\Request::TABLE . '.level_id', '=', Testing::TABLE . '.level_id');
                    })
                    ->leftJoin(Training::TABLE, function (JoinClause $join) use ($groupTraining) {
                        $join->on(Training::TABLE . '.morphtable_id', '=', Testing::TABLE . '.id')
                            ->where(Training::TABLE . '.user_id', '=', $groupTraining->getUser()->id)
                            ->where(Training::TABLE . '.morphtable_type', '=', Testing::class)
                            ->whereNull(Training::TABLE . '.deleted_at');
                    })
                    ->select([
                        \App\Models\Request::TABLE . '.*',
                        Training::TABLE . '.passed'
                    ])
                    ->first());
        } catch (\Exception $exception) {
            return response()
                ->json(['error' => $exception->getMessage()], 420);
        }
    }


    /**
     * Вывести заявку
     *
     * @param string $type
     * @param int|null $level
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRequestList(string $type, ?int $level = null, Request $request)
    {
        try {
            if($type !== Role::KINDERGARTEN_TYPE){
                $level = LevelContainer::getLevelByNumber($level, Direction::getIdForName($type));
                $groupTraining = RequestContainer::getListUser($level);
            } else {
                $groupTraining = RequestContainer::getListKindergarten();
            }


            if ($request->get('filter')) {
                $groupTraining = (new Filter($groupTraining, $request->get('filter')))->getFilter();
            }

            return response()
                ->json([
                    'request' => $groupTraining->get()
                ]);
        } catch (\Exception $exception) {
            return response()
                ->json(['error' => $exception->getMessage()], 420);
        }
    }

    /**
     * Обновить список заявок
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        RequestContainer::updateList($request->get('data'));
        if ($request->get('updateType') && $request->get('data')) {
            $requestList = RequestContainer::getRequestListForNutification($request->get('data'));
            $typeUpdate = $request->get('updateType');
            foreach ($requestList as $item) {
                $message = new NotificationMessageRequest($item->idRequest, $typeUpdate);
                NotificationContainer::send(\Auth::user(), $message->getMessage());
                //\Auth::user()->notify((new UserNotification($message->getMessage())));
            }
        }
        return response()
            ->json('OK!!!');
    }

    /**
     * Вывести группы для заявок
     *
     * @param string $type
     * @param int $level
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getGroupList(string $type, int $level = null)
    {
        $group = new RequestGroupContainer();
        if ($level) {
            $levelId = LevelContainer::getLevelByNumber($level, Direction::getIdForName($type))->id;
            $result = $group->getListInLevel($levelId);
        } else {
            $user = \Auth::user();
            $result = $group->getListInDirectionForUser(Direction::getIdForName($type), $user);

        }

        return response()
            ->json([
                'groups' => $result
            ]);
    }

    /**
     * Вывести группы заявок по всем направлениям
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllGroupList()
    {
        return response()
            ->json([
                'groups' => (new RequestGroupContainer())->getListInDirectionForExpert(\Auth::user())
            ]);
    }

    /**
     * Вывести группы заявок по всем направлениям
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getKindergartenRequest()
    {
        if (\Auth::user()->role_id === Role::ID_EXPERT) {
            $field = 'expert_id';
        } else {
            $field = 'user_id';
        }
        return response()
            ->json([
                'groups' => RequestContainer::getListKindergarten()
                    ->where(\App\Models\Request::TABLE . ".$field", '=', \Auth::id())
                    ->leftJoin(Testing::TABLE,function (JoinClause $join){
                        $join->on(\App\Models\Request::TABLE.'.level_id','=',Testing::TABLE.'.id');
                    })
                    ->leftJoin(Level::TABLE, function (JoinClause $join) {
                        $join->on(\App\Models\Request::TABLE . '.level_id', '=', Level::TABLE . '.id');
                    })
                    ->leftJoin(Training::TABLE, function (JoinClause $join) {
                        $join->on(\App\Models\Request::TABLE . '.user_id', '=', Training::TABLE . '.user_id')
                            ->on(Training::TABLE . '.morphtable_id', '=', Testing::TABLE . '.id')
                            ->where(Training::TABLE . '.morphtable_type', '=', Testing::class)
                            ->where(Training::TABLE . '.passed', '=', true)
                            ->whereNull(Training::TABLE . '.deleted_at');
                    })
                    ->select([
                        \App\Models\Request::TABLE.'.*',
                        Level::TABLE.'.direction_id',
                        DB::raw('max('.Training::TABLE.'.id) as training_id')
                    ])
                    ->groupBy(\App\Models\Request::TABLE.'.id')
                    ->get()
            ]);
    }

    /**
     * Вывести заявки внутри группы
     *
     * @param int $groupId
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadRequestGroup(int $groupId)
    {
        return response()
            ->json([
                RequestGroupContainer::getRequestGroup($groupId)
            ]);
    }

    /**
     * Создать группы для заявок
     *
     * @param string $type
     * @param int $level
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function createRequestGroup(string $type, int $level, Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        /** @var Level $level */
        $level = LevelContainer::getLevelByNumber($level, Direction::getIdForName($type));
        $group = new RequestGroupContainer();
        return response()
            ->json([
                'groups' => $group->createGroup($request->get('name'), $level->id)
            ]);
    }

    /**
     * Обновить список групп
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRequestGroup(Request $request)
    {
        $data = array_map(function ($item) {
            if (isset($item['requests_count'])) {
                unset($item['requests_count']);
            }
            return $item;
        }, $request->get('data'));
        if (isset($data['date_of_meeting'])) {
            $data['date_of_meeting'] = (new Carbon($data['date_of_meeting']));
        }

        $group = RequestGroupContainer::updateList($data);
        $idGroup =  isset($data['id']) ? [$data['id']] : array_column($data, 'id');
        $requestList = \App\Models\Request::whereIn('group_request_id', $idGroup)->get();
        $typeUpdate = $request->get('updateType');
        foreach ($requestList as $item) {
            $message = new NotificationMessageRequest($item->id, $typeUpdate);
            NotificationContainer::send(User::find($item->user_id), $message->getMessage());
            //\Auth::user()->notify((new UserNotification($message->getMessage())));
        }
        return response()
            ->json([
                'groups' => $group
            ]);
    }

    /**
     * удалить группу для заявок
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(int $id)
    {
        return response()
            ->json([
                RequestGroupContainer::delete($id)
            ]);

    }

    /**
     * Дать доступ к прохождению теста
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function openTestingForUser(Request $request)
    {
        if ($item = RequestContainer::checkRequest($request->get('id'))) {
            $message = new NotificationMessageRequest($request->get('id'), $request->get('updateType'));

            //\Auth::user()->notify((new UserNotification($message->getMessage())));
            return response()
                ->json('OK!!!', 200);
        } else {
            return response()
                ->json([
                    'Error!!!'
                ], 420);
        }
    }

    /**
     * Записать мнение эксперта, по этапу обучения открыть доступ к слудующиму этапу
     *
     * @param int $trainingId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setExpertOpinion(int $trainingId, Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ]);
        $training = Training::findOrFail($trainingId);

        TrainingsContainer::setExpertOpinion($training, $request->get('comment'), \Auth::id());
        if ($request->get('access')) {
            ProgressContainer::complete(new TrainingsContainer($training->users, $training->morphtable, $training));
            // Назначение роли эксперта
            if ($training->morphtable->level->number === 3) {
                $training->users()->update([
                    'role_id' => Role::ID_EXPERT
                ]);
            }
            // просвоить занчёк для каб детского сада
            if ($training->morphtable->level->number === 4) {
                \App\Models\Request::where('level_id', '=', $training->morphtable->level->id)
                    ->where('user_id', '=', $training->user_id)
                    ->update([
                        'check' => true
                    ]);
            }

        }
        return response()
            ->json('OK!!!', 200);
    }
}
