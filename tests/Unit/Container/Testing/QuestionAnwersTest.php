<?php

namespace Tests\Unit\Container\Testing;

use App\Container\Testing\TrainingsContainer;
use App\Models\Testing;
use App\User;
use Illuminate\Container\Container;
use Tests\TestCase;

/**
 * - запись ответа на вопрос
 * - проверка на верность ответа
 *
 * Class QuestionAnwersTest
 * @package Tests\Unit\Container\Testing
 */
class QuestionAnwersTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testExample()
    {
        $trainings = Container::getInstance()
            ->make(TrainingsContainer::class, [
                'user' => User::find(1),
                'model' => Testing::find(4)
            ]);
        $list = $trainings->getList()->get()->toArray();
        $sumAnswerUser = 0;
        foreach ($list as $item) {
            if(isset($item['answer_user']['answer'])){
                $answerUser = \GuzzleHttp\json_decode($item['answer_user']['answer']);
                $sumAnswerUser += array_sum($answerUser);
            } else {
                $sumAnswerUser += 0;
            }

            //$sumAnswerUser+= array_sum();
        }
        dd($sumAnswerUser/count($list));
        $this->assertTrue(true);
    }
}
