<?php

namespace App\Container\Notification;


use App\Models\Direction;
use App\Models\GroupRequests;
use App\Models\Level;
use App\Models\Request;
use App\User;

class NotificationMessageRequest implements InterfaceNotification
{
    /**
     * Данные заявки
     *
     * @var Request
     */
    private $request;

    /**
     * Тип действий с заявкой
     *
     * @var string
     */
    private $typeUpdate;

    // Типы обновления заявки
    const PLACE_TYPE = 'place';
    const ASSIGNED_EXPERT_TYPE = 'assigned';
    const ACCESSE_FOR_TESTING = 'access';

    const TYPE_REQUEST = [
        2 => 'внешней оценке качества',
        3 => 'экспертной оценке качества'
    ];

    // сообщение
    const ASSIGNED_EXPERT_MASSEGE = "<span>  На Вашу заявку по %s %s<span class='text-500'> назначен экспет %s Контактные данные эксперта: %s %s</span>";
    const PLACE_MASSEGE = "<span>  Встреча <span class='text-500'> по %s %s состоится по адресу %s в %s .</span>";
    const ACCESSE_TESTING_MASSEGE = "<span>  Вам открыт доступ для прохождения тестирования<span class='text-500'> по %s %s .</span>";

    /**
     * NotificationMessageRequest constructor.
     * @param int $requestId
     * @param string $typeUpdate
     */
    public function __construct(int $requestId, string $typeUpdate)
    {
        $this->request = $this->getDataForRequest($requestId)->first();
        $this->typeUpdate = $typeUpdate;
    }

    public function getMessage(): string
    {
        $result = '';
        $directionRus = Direction::DIRECTION_LIST_RUS[$this->request->direction_id];
        switch ($this->typeUpdate) {
            case self::ASSIGNED_EXPERT_TYPE:
                if($this->request->name && $this->request->phone && $this->request->email){
                    $result = sprintf(self::ASSIGNED_EXPERT_MASSEGE,
                        self::TYPE_REQUEST[$this->request->number],
                        $directionRus,
                        $this->request->name,
                        $this->request->phone,
                        $this->request->email
                    );
                }
                break;
            case self::PLACE_TYPE:
                if($this->request->place && $this->request->date_of_meeting){
                    $result = sprintf(self::PLACE_MASSEGE,
                        self::TYPE_REQUEST[$this->request->number],
                        $directionRus,
                        $this->request->place,
                        $this->request->date_of_meeting
                    );
                }
                break;
            case self::ACCESSE_FOR_TESTING:
                if($this->request->check){
                    $result = sprintf(self::ACCESSE_TESTING_MASSEGE,
                        self::TYPE_REQUEST[$this->request->number],
                        $directionRus
                    );
                }
                break;

        }
        return $result;
    }

    /**
     * @param $request
     * @return $this|\Illuminate\Database\Query\Builder
     */
    private function getDataForRequest($requestId)
    {
        return Request::where(Request::TABLE . '.id', '=', $requestId)
            ->leftJoin(GroupRequests::TABLE, Request::TABLE . '.group_request_id', '=', GroupRequests::TABLE . '.id')
            ->leftJoin(User::TABLE, GroupRequests::TABLE . '.expert_id', '=', User::TABLE . '.id')
            ->leftJoin(Level::TABLE, Request::TABLE . '.level_id', '=', Level::TABLE . '.id')
            ->select([
                Request::TABLE . '.check',
                GroupRequests::TABLE . '.place',
                GroupRequests::TABLE . '.date_of_meeting',
                Level::TABLE . '.direction_id',
                Level::TABLE . '.number',
                User::TABLE . '.name',
                User::TABLE . '.email',
                User::TABLE . '.phone',
            ]);

    }

}