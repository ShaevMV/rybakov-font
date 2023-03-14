<?php

use App\Models\Level;
use App\Models\Testing;
use Illuminate\Database\Migrations\Migration;

class UpdateTestingRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $levels = Level::whereNumber(4)->get();
        foreach ($levels as $level){
            $oldlevel = Level::where([
                'number' => 1,
                'direction_id' => $level->direction_id
            ])->first();
            Testing::whereLevelId(
                $oldlevel->id
            )->delete();

            Testing::whereLevelId(
                $level->id
            )->update([
                'level_id' => $oldlevel->id
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
