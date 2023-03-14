<?php

namespace Tests\Unit\Container;

use App\Container\Expert\ExpertsContainer;
use App\Models\Expert;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * - Вывести список всех экспертов
 *
 * Class ExpertsTest
 * @package Tests\Unit\Container
 */
class ExpertsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetListExperts()
    {
        $experts = (new ExpertsContainer())->getList();
        dd($experts->get());
        $this->assertInstanceOf(Expert::class, $experts);
        $this->assertNotEmpty($experts->get());
    }
}
