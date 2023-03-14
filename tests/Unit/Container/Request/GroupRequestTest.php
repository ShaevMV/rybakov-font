<?php

namespace Tests\Unit\Container\Request;

use App\Container\GroupTraining\RequestGroupContainer;
use App\Http\Requests\RequestQuestions;
use App\Models\Expert;
use App\Models\GroupRequests;
use App\Models\Level;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * - Тест создание группы для заявок
 * - Тест вывода группы заявок
 * - Тест назначение эксперта к группе заявок
 *
 * Class GroupRequestTest
 * @package Tests\Unit\Container
 */
class GroupRequestTest extends TestCase
{
    /**
     * Тест создание группы для заявок
     *
     * @return void
     */
    public function testCreateGroup()
    {
        $group = new RequestGroupContainer();
        $this->assertInstanceOf(GroupRequests::class, $group->createGroup('новая группа',2));
    }

    /**
     * Тест вывода группы заявок
     *
     * @return void
     */
    public function testGetListGroup()
    {
        $group = new RequestGroupContainer(Level::find(2));
        $this->assertNotEmpty($group->getList());
        $this->assertArrayHasKey('requests_count', $group->getList()[0]);
    }

    /**
     * Тест назначение эксперта к группе заявок
     *
     * @return void
     */
    public function testAssignExpertForGroup()
    {
        $group = RequestGroupContainer::assignExpertForGroup(1, User::whereRoleId(4)->firstOr());
        $this->assertTrue($group);
    }


}
