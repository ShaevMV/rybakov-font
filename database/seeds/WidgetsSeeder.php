<?php

use Illuminate\Database\Seeder;

class WidgetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Widget::class, 9)->create();
    }
}
