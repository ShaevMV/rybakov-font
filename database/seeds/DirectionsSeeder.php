<?php

use App\Models\Direction;
use App\Models\Level;
use App\Models\Stage;
use Illuminate\Database\Seeder;

class DirectionsSeeder extends Seeder
{
    const COUNT_LEVEL = 3;
    const COUNT_STAGES = 2;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Direction::DIRECTION_LIST_RUS as $item) {
            $direction = Direction::create([
                'name' =>  $item
            ]);
            //$direction->save();
            $direction->levels()->saveMany($this->createLevel());
            //dump($direction->id);
            $direction->save();
        }
    }

    /**
     * Создать список уровней и вывести их для прикрыпление к напровлению
     *
     * @return array
     */
    private function createLevel(): array
    {
        $levels = [];
        for ($i = 1; $i <= self::COUNT_LEVEL; $i++) {
            $level = new Level();
            $level->number = $i;
            $level->save();
            if($i !== self::COUNT_LEVEL){
                $level->stages()->saveMany($this->createStage());
            }
            //$level->save();

            $levels[] = $level;
        }
        return $levels;
    }

    /**
     * Создать список уровней
     *
     * @return array
     */
    private function createStage(): array
    {
        $stages = [];
        for ($i = 1; $i <= self::COUNT_STAGES; $i++) {
            $stage = new Stage();
            $stage->number = $i;
            $stage->save();

            $stages[] = $stage;
        }
        return $stages;
    }
}
