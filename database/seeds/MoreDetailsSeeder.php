<?php

use Illuminate\Database\Seeder;

class MoreDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = \App\Models\Level::where('number','<',4)->get();
        foreach ($levels as $item){
            $moreDetails = new \App\Models\MoreDetails();
            $moreDetails->level_id = $item->id;
            $moreDetails->save();
        }

    }
}
