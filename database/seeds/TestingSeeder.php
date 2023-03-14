<?php

use App\Models\Question;
use App\Models\Testing;
use Illuminate\Database\Seeder;

class TestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Level::all() as $item) {
            factory(Testing::class, 1)->create()->each(function (Testing $test) use ($item) {
                //$count = $item->number == 4 ? 300 : 2;
                $count = 2;
                $test->auto_complete = $item->number === 1;
                $test->type = $item->number == 1 ? Testing::TYPE_TESTING : Testing::TYPE_TEST;
                $test->questions()->saveMany(
                    factory(Question::class, $count)->make()->each(function (Question $question) use ($item) {
                        $question->save();
                        if ($item->number == 1) {
                            $options = \App\Container\Testing\Question\QuestionModel::getOptionsForTesting($item->direction_id);
                            $question->options = json_encode($options);
                            $question->type = Question::TESTING;
                        }
                    })
                );
                $test->level()->associate($item);
                $test->save();
            });
        }
    }
}
