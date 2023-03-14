<?php

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directions = \App\Models\Direction::all();
        foreach ($directions as $direction){
            factory(Lesson::class, 3)->create()->each(function (Lesson $lesson) use ($direction) {
                static $index;
                $lessonIndex = ++$index;
                $lesson->directions()->associate($direction);
                $lesson->title = $lessonIndex . ' урок';
                $lesson->sort = $lessonIndex;
                $lesson->save();
                $lesson->tasks()->saveMany(factory(\App\Models\Task::class,6)->make());
                $lesson->save();
            });
        }
    }
}
