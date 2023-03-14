<?php

use App\Classes\Core\Cache\CacheInterface;
use App\Classes\Core\Cache\RedisCache;
use App\Container\Token\TokenContainer;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function run()
    {
        $this->call(WidgetsSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DirectionsSeeder::class);
        if(config('app.env') === 'dev'){
            $this->call(PlatformsSeeder::class);
            $this->call(LessonSeeder::class);
            $this->call(TestingSeeder::class);
        }
        $this->call(UpdateLevelSeed::class);
        // создать данные для api
        Artisan::call('passport:install');
        // очистка токена приложения
        $container = Container::getInstance();
        $container->bind(CacheInterface::class, RedisCache::class);
        $token = $container->make(TokenContainer::class);
        $token->clearToken();
    }
}
