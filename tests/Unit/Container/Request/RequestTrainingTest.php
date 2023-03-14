<?php

namespace Tests\Unit\Container\Request;

use App\Container\GroupTraining\RequestContainer;
use App\Container\Level\LevelContainer;
use App\Models\Direction;
use App\Models\Expert;
use App\Models\Request;
use App\Models\Stage;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * + Тест создания заявки/Тест вывода данных по заявки
 * + Тест провода платежа
 * + Тест назначения эксперта
 * + Тест назначения даты проведения
 * + Тест провидения обучения
 * + Тест получения списка id user
 * + Тест получения этапа и
 * + Тест пользователя(ей) в заявках
 * - Тест получение списка заявок по определённому уровню
 *
 * Class GroupTrainingTest
 * @package Tests\Unit\Container
 */
class RequestTrainingTest extends TestCase
{
    /**
     * Тест создания заявки/Тест вывода данных по заявки
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     * @param int $numberLevel
     * @return void
     */
    public function testCreateAppGroupTraining(int $idDirection, int $numberLevel)
    {
        $level = LevelContainer::getLevelByNumber($numberLevel, $idDirection);
        $newGroupTraining = RequestContainer::setGroupTraining([
            'user_id' => 1,
            'city' => 'СПБ',
            'level_id' => $level->id,
            'fio' => 'Иванов Иван Иванович',
            'phone' => '+79516619781',
            'email' => 'shaevMV@gmal.com',
        ]);
        $this->assertInstanceOf(Request::class, $newGroupTraining);
        $groupTraining = new RequestContainer(User::find(1), $level);
        $this->assertEquals($newGroupTraining->id, $groupTraining->getGroupTrainingModel()->first()->id);
    }

    /**
     * Тест провода платежа
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     * @param int $numberLevel
     * @return void
     */
    public function testPayGroupTraining(int $idDirection, int $numberLevel)
    {
        $groupTraining = new RequestContainer(User::find(1), LevelContainer::getLevelByNumber($numberLevel, $idDirection));
        $this->assertTrue($groupTraining->pay(true));
        $this->assertEquals(1, $groupTraining->getGroupTrainingModel()->first()->payment_subject);
    }

    /**
     * Тест назначения эксперта
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     * @param int $numberLevel
     * @return void
     */
    public function testExpertAppointment(int $idDirection, int $numberLevel)
    {
        $groupTraining = new RequestContainer(User::find([1, 2]), LevelContainer::getLevelByNumber($numberLevel, $idDirection));
        $this->assertTrue($groupTraining->setExpert(Expert::find(2)));
        foreach ($groupTraining->getGroupTrainingModel()->get() as $item) {
            $this->assertEquals(2, $item->expert_id);
        }

    }

    /**
     * Тест назначения даты проведения
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     * @param int $numberLevel
     * @return void
     */
    public function testSetDates(int $idDirection, int $numberLevel)
    {
        $groupTraining = new RequestContainer(User::find([1, 2]), LevelContainer::getLevelByNumber($numberLevel, $idDirection));
        $date = Carbon::now()->addDay();
        $this->assertTrue($groupTraining->setDates($date));
        foreach ($groupTraining->getGroupTrainingModel()->get() as $item) {
            $this->assertEquals($date, $item->date_of_meeting);
        }
    }

    /**
     * Тест получения списка id user
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     * @param int $numberLevel
     * @return void
     */
    public function testGetUsersId(int $idDirection, int $numberLevel)
    {
        $class = new \ReflectionClass(RequestContainer::class);
        $method = $class->getMethod('getIdUser');
        $method->setAccessible(true);
        $groupTraining = new RequestContainer(User::find([1, 2]), LevelContainer::getLevelByNumber($numberLevel, $idDirection));
        $result = $method->invoke($groupTraining);
        $this->assertEquals([1, 2], $result);
    }


    /**
     * Тест провидения обучения
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     * @param int $numberLevel
     * @return void
     */
    public function testComplete(int $idDirection, int $numberLevel)
    {
        $groupTraining = new RequestContainer(User::find([1, 2]), LevelContainer::getLevelByNumber($numberLevel, $idDirection));
        $groupTraining->complete();
        foreach ($groupTraining->getGroupTrainingModel()->get() as $item) {
            $this->assertEquals(1, $item->check);
        }
    }


    /**
     * Тест получения этапа
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     * @param int $numberLevel
     * @return void
     */
    public function testGetStage(int $idDirection, int $numberLevel)
    {
        $groupTraining = new RequestContainer(User::find([1, 2]), LevelContainer::getLevelByNumber($numberLevel, $idDirection));
        $this->assertInstanceOf(Stage::class, $groupTraining->getStage());
        $this->assertEquals(Request::STAGE_NUMBER, $groupTraining->getStage()->number);

    }


    /**
     * Тест получения этапа пользователей
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     * @param int $numberLevel
     * @return void
     */
    public function testGetUser(int $idDirection, int $numberLevel)
    {
        $groupTraining = new RequestContainer(User::find([1, 2]), LevelContainer::getLevelByNumber($numberLevel, $idDirection));

        $this->assertNotEmpty($groupTraining->getUser());
        $this->assertEquals(Request::STAGE_NUMBER, $groupTraining->getStage()->number);

    }

    /**
     * Тест получения заявки
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     * @param int $numberLevel
     * @return void
     */
    public function testGetRequest(int $idDirection, int $numberLevel)
    {
        $groupTraining = new RequestContainer(User::find(1), LevelContainer::getLevelByNumber($numberLevel, $idDirection));
        $this->assertInstanceOf(Request::class,$groupTraining->getGroupTrainingModel()->first());
    }


    /**
     * Тест получение списка заявок по определённому уровню
     *
     * @dataProvider directionProvider
     * @param int $idDirection
     * @param int $numberLevel
     * @return void
     */
    public function testGetListRequest(int $idDirection, int $numberLevel)
    {
        $groupTraining = RequestContainer::getList(LevelContainer::getLevelByNumber($numberLevel, $idDirection))
            ->get();

        $this->assertInstanceOf(Collection::class ,$groupTraining);
    }

    /**
     * Вывести направления и номер уровня
     *
     * @return array
     */
    public function directionProvider()
    {
        return [
            [Direction::ID_NOKDO, 2],
            [Direction::ID_ECERS, 2]
        ];
    }
}
