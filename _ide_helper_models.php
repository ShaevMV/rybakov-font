<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AnswerOptions
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $question_id Вопрос
 * @property mixed|null $options Варианты ответа
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerOptions whereUpdatedAt($value)
 */
	class AnswerOptions extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AnswerUsers
 *
 * @property int $id
 * @property int|null $question_id Вопросы
 * @property int|null $training_id Обучение
 * @property int|null $user_id Пользователь
 * @property string|null $answer Ответ
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Question|null $questions
 * @property-read \App\Models\Training|null $trainings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereTrainingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerUsers whereUserId($value)
 * @mixin \Eloquent
 */
	class AnswerUsers extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Certificate
 *
 * @property int $id
 * @property string $pdf
 * @property int $training_id Обучение
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate wherePdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereTrainingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id пользователь
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereUserId($value)
 * @property string $image ссылка на картинку
 * @property string $title название сертификата
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereTitle($value)
 * @property int $level_id уровень
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereLevelId($value)
 * @property int $stage_id этап
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Certificate whereStageId($value)
 */
	class Certificate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Direction
 *
 * @property int $id
 * @property string $name название направления
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Level[] $levels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 */
	class Direction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GroupRequests
 *
 * @property int $id
 * @property int|null $expert_id Назначенный эксперт
 * @property int|null $level_id Уровень
 * @property string|null $name Название группы
 * @property string|null $date_of_meeting Дата встречи
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task insertOnDuplicateKey($key)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereDateOfMeeting($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereExpertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $place место провидения
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Level|null $levels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Request[] $requests
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GroupRequests onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupRequests wherePlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GroupRequests withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GroupRequests withoutTrashed()
 */
	class GroupRequests extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property int|null $direction_id направления
 * @property string $title название урока
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Direction|null $directions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereDirectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson withoutTrashed()
 * @property int|null $sort
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereSort($value)
 */
	class Lesson extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Level
 *
 * @property int $id
 * @property int|null $direction_id направления
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stage[] $stages
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level whereDirectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $name Название уровня
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level whereName($value)
 * @property int $number Номер уровня
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Level whereNumber($value)
 * @property-read \App\Models\Direction|null $directions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Testing[] $testings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Certificate[] $certificates
 */
	class Level extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Notification
 *
 * @property int $id
 * @property int|null $user_id Получатель
 * @property string|null $isPassed Позитивное ли уведомление
 * @property string|null $message Сообщения
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereIsPassed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereUserId($value)
 * @mixin \Eloquent
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Organization
 *
 * @property int $id
 * @property string $name Название детского сада
 * @property string $address Адрес детского сада
 * @property int $user_id Представитель
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereUserId($value)
 * @mixin \Eloquent
 * @property string $name_organization Название детского сада
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereNameOrganization($value)
 */
	class Organization extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Platform
 *
 * @property int $id
 * @property string $title название платформы
 * @property string $link ссылка на платформу
 * @property int $active статус активности
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Platform extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Progress
 *
 * @property int $id
 * @property int $user_id пользователь
 * @property int $level_id Доступный уровень
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Level $levels
 * @property int $stage_id Доступный этап
 * @property-read \App\Models\Stage $stages
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Progress whereStageId($value)
 */
	class Progress extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Question
 *
 * @property int $id
 * @property int|null $testing_id тестирования
 * @property string $text текст вопроса
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Testing|null $testings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereTestingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\AnswerOptions $answerOptions
 * @property-read \App\Models\AnswerOptions $answer_options
 * @property-read \App\Models\AnswerUsers $answer_user
 * @property string $type Тип вопроса
 * @property mixed|null $options Варианты ответов
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $morphtable_type связаная таблица
 * @property int|null $morphtable_id связаная сущность
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $morphtable
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereMorphtableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereMorphtableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question withoutTrashed()
 */
	class Question extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Request
 *
 * @property int $id
 * @property int|null $user_id Пользователь
 * @property int|null $expert_id Назначенный эксперт
 * @property int $payment_subject статус оплаты
 * @property string $city Город
 * @property string $fio Фамилия, имя и отчество
 * @property string $phone Телефон
 * @property string $email Емейл
 * @property string|null $date_of_meeting Дата встречи
 * @property int $check Факт посещение оналайн лекции
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereCheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereDateOfMeeting($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereExpertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereFio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request wherePaymentSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereUserId($value)
 * @mixin \Eloquent
 * @property int|null $level_id Уровень
 * @property-read \App\Models\Level|null $levels
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereLevelId($value)
 * @property int|null $group_request_id группа заявок
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Request whereGroupRequestId($value)
 * @property-read \App\Models\GroupRequests|null $group_requests
 */
	class Request extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $sort Порядок сортировки
 * @property string $name Название отзыва
 * @property string $image Путь к картинке
 * @property int $active Признак активности
 * @property string $description Отзыв
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Review extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name тип роли
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @property string $name
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereValue($value)
 * @mixin \Eloquent
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Stage
 *
 * @property int $id
 * @property int|null $level_id уровень
 * @method static Builder|\App\Models\Stage newModelQuery()
 * @method static Builder|\App\Models\Stage newQuery()
 * @method static Builder|\App\Models\Stage query()
 * @method static Builder|\App\Models\Stage whereId($value)
 * @method static Builder|\App\Models\Stage whereLevelId($value)
 * @mixin \Eloquent
 * @property string $name Название этапа
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|\App\Models\Stage whereCreatedAt($value)
 * @method static Builder|\App\Models\Stage whereName($value)
 * @method static Builder|\App\Models\Stage whereUpdatedAt($value)
 * @property int|null $testing_id тестирования
 * @property-read \App\Models\Testing|null $testings
 * @method static Builder|\App\Models\Stage whereTestingId($value)
 * @property int $number Номер этапа
 * @method static Builder|\App\Models\Stage whereNumber($value)
 * @property-read \App\Models\Level|null $levels
 */
	class Stage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Task
 *
 * @property int $id
 * @property int|null $lesson_id урок
 * @property string $type тип текста или видео
 * @property string $title название задания
 * @property string $content содержание
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lesson|null $lessons
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task insertOnDuplicateKey($key)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $description Описание
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereDescription($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TaskSelect[] $selectTasks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 */
	class Task extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TaskSelect
 *
 * @property int $id
 * @property int $user_id пользователь
 * @property int $task_id задача
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect whereUserId($value)
 * @mixin \Eloquent
 * @property int|null $direction_id направление
 * @property-read \App\Models\Task $tasks
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskSelect whereDirectionId($value)
 */
	class TaskSelect extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Testing
 *
 * @property int $id
 * @property int|null $stage_id Этап
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $active активность теста
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereActive($value)
 * @property int $auto_assessment Автопрохождение теста
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereAutoAssessment($value)
 * @property-read \App\Models\Stage|null $stages
 * @property int|null $level_id Уровень
 * @property string $description Описание
 * @property-read \App\Models\Level|null $level
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereLevelId($value)
 * @property string $type Тип тестирования (тест, тестирование)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Training[] $trainings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereType($value)
 * @property int $auto_complete автозавершение теста
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testing whereAutoComplete($value)
 */
	class Testing extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Training
 *
 * @property int $id
 * @property int $direction_id Направление
 * @property int $user_id Пользователь
 * @property int $expert_id Эксперт
 * @property int $testing_id Тест
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereDirectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereExpertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereTestingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $expert_opinion Мнение эксперта
 * @property string|null $assessment Оценка
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Certificate[] $certificates
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereAssessment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereExpertOpinion($value)
 * @property-read \App\Models\Testing $testings
 * @property-read \App\User $users
 * @property int $passed пройден тест
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training wherePassed($value)
 * @property string|null $morphtable_type связаные таблицы
 * @property int|null $morphtable_id связаные таблицы
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereMorphtableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereMorphtableType($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Training[] $morphtable
 */
	class Training extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ModelWidget
 *
 * @property int $id
 * @property string $title Заголовок
 * @property int $ordering Порядок отображения
 * @property int $active Активность
 * @property string $template Шаблон
 * @property mixed $params
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereTitle($value)
 * @mixin \Eloquent
 * @property int $sort Порядок отображения
 * @property string $join_data Подключаемые данные
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereJoinData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereSort($value)
 * @property string $data_join Присоединенные данные
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereDataJoin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereUpdatedAt($value)
 */
	class Widget extends \Eloquent {}
}

namespace App{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $role_id Роль пользователя
 * @property string $phone телефон
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\Role $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $position должность
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePosition($value)
 * @property int|null $organization_id Детский сад
 * @property-read \App\Models\Organization|null $organizations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereOrganizationId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Progress[] $progress
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Certificate[] $certificates
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Training[] $trainings
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
 */
	class User extends \Eloquent {}
}

