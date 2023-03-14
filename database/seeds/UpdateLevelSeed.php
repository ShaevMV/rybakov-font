<?php

use Illuminate\Database\Seeder;

class UpdateLevelSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = \App\Models\Level::where('number', '=', 4)->get();
        foreach ($levels as $level){
            $level->stages()->save(
                \App\Models\Stage::create([
                    'number' => 1
                ])
            );
        }
    }
}
