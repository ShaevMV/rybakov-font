<?php

use App\Classes\Widget\WidgetContainer;
use App\Models\Expert;
use App\Models\Review;
use App\Models\Role;
use App\User;
//use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Widget;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

// Пользователи
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker $faker) {
    static $password;
    return [
        'name' => \Faker\Factory::create('Ru_RU')->name(),
        'email' => 'admin@admin.ru',
        'role_id' => Role::whereName(Role::ADMIN_TYPE)->first()->id,
        'email_verified_at' => now(),
        'phone' => $faker->phoneNumber,
        'password' => $password ?: $password = bcrypt('secret')
    ];
});

// Виджеты
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Widget::class, function (Faker $faker) {
    static $index = 0;
    $tempIndex = $index++;
    $template = WidgetContainer::TEMPLATE_LIST[$tempIndex];

    /*if ($template['name'] == 'experts') {
        $dataJoin = Expert::class;
    } elseif ($template['name'] == 'reviews') {
        $dataJoin = Review::class;
    } else {
        $dataJoin = '';
    }*/
    $params = [];
    $tempParams = [];

    if ($template['type'] === 'array') {
        for ($i = 0; $i < $template['count']; $i++) {
            foreach ($template['params'] as $key => $item) {
                $tempParams[$key] = getFakerForType($item, $faker);
            }
            $params[] = $tempParams;
        }
    } else {
        foreach ($template['params'] as $key => $item) {
            $tempParams[$key] = getFakerForType($item, $faker);
        }
        $params = $tempParams;
    }

    return [
        'title' => $template['name'],
        'sort' => $tempIndex,
        'template' => $template['name'],
        'active' => false,
        'params' => json_encode($params),
        'data_join' => ''
    ];
});
/**
 * Подставка типа для виджитов
 *
 * @param string $type
 * @param Faker $faker
 * @return string
 */
function getFakerForType(string $type, Faker $faker)
{
    switch ($type) {
        case 'string':
            $result = $faker->sentence(1);
            break;
        case 'image':
            $result = $faker->imageUrl();
            break;
        case 'url':
            $result = $faker->url;
            break;
        default:
            $result = '';
    }
    return $result;
}


// Эксперты
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Expert::class, function () {
    $faker = \Faker\Factory::create('Ru_RU');
    return [
        'name' => $faker->name(),
        'image' => $faker->imageUrl(),
        'active' => true,
        'user_id' => NULL,
        'description' => '<p>'.$faker->text(100).'</p>'
    ];
});

// Отзывы
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Review::class, function () {
    $faker = \Faker\Factory::create('Ru_RU');
    return [
        'sort' => $faker->numberBetween(1,100),
        'name' => $faker->name(),
        'image' => $faker->imageUrl(),
        'active' => true,
        'description' => '<p>'.$faker->text(100).'</p>',
    ];
});

// Роли
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Role::class, function () {
    static $index = 0;

    return [
        'name' => Role::ROLES_TYPE[$index++],
    ];
});

// платформы
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Platform::class, function () {
    $faker = \Faker\Factory::create('Ru_RU');

    return [
        'title' => $faker->sentence(1),
        'link' => 'https://www.google.com'
    ];
});

// уроки
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Lesson::class, function () {
    return [
        'title' => "урок"
    ];
});

// задания для урока
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Task::class, function () {
    static $index = 0;
    $tempIndex = ++$index;
    if($tempIndex>=6) $index = 0;
    $faker = \Faker\Factory::create('Ru_RU');
    $temp = $faker->randomNumber(2);
    $type = $temp % 2 ? 'video': 'text';

    return [
        'title' => "Задания $tempIndex",
        'type' => $type,
        'description' => $faker->words(3,true),
        'content' => $temp % 2 ? $faker->title(1) : $faker->text()
    ];
});

// Тесты
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Testing::class, function () {
    $faker = \Faker\Factory::create('Ru_RU');
    return [
        'description' => $faker->text(),
    ];
});


// Вопросы
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Question::class, function () {
    $faker = \Faker\Factory::create('Ru_RU');
    $type = rand(0, 1);
    $options = [];
    if (!$type) {
        $i = 0;
        while ($i < \App\Models\Question::COUNT_OPTION) {
            $options[] = [
                'answer' => $faker->text(20),
                'right' => $i === 0
            ];
            $i++;
        }
    }
    return [
        'text' => $faker->text(),
        'type' => \App\Models\Question::TYPE_ANSWER_OPTIONS[$type],
        'options' => json_encode($options),
    ];
});

