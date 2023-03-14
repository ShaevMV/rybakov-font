<?php

namespace App\Container\Notification;


use App\Models\Direction;
use App\Models\Stage;

class NotificationMessageLevel implements InterfaceNotification
{
    const REQUEST_OR_LESSON_STAGE = 1;
    const TEST_STAGE = 2;
    const TESTING_STAGE = 1;

    const LEVEL1 = 1;
    const LEVEL2 = 2;
    const LEVEL3 = 3;
    const LEVEL4 = 4;

    const MESSAGE_LESSON = '<span class="uk-text-bold">Поздравляем! </span>  
                Вы закончили онлайн обучения по ветке %s. 
                Можете продолжить обучение';
    const MESSAGE_TEST = '<span class="uk-text-bold">Поздравляем! </span>  
                Вы закончили %d уровень обучения по ветке %s. 
                Можете продолжить обучение';
    const MESSAGE_EXPERT = '<span class="uk-text-bold">Поздравляем! </span>  
                Вы закончили %d уровень обучения по ветке %s. 
                Вам присвоен статуст эксперта, пожалуста выйдите и заново зайдите в систему.';
    const MESSAGE_REQUEST_LEVEL2 = '<span>   Ваша заявка на <span class="text-500">
                внешнюю оценку %s принята.</span>  
                Эксперт свяжется с Вами в ближайшее время.</span>';
    const MESSAGE_REQUEST_LEVEL3 = '<span>   Ваша заявка на <span class="text-500">  
                экспертную оценку качества %s принята.</span>  
                Эксперт свяжется с Вами в ближайшее время.</span>';
    const MESSAGE_REQUEST_LEVEL4 = '<span class="uk-text-bold">Поздравляем! </span>  
                Вы закончили тестирование по ветке %s.
                 Можете продолжить обучение';
    /**
     * @var Stage
     */
    private $stage;

    public function __construct(Stage $stage)
    {
        $this->stage = $stage;
    }

    /**
     * Вывести текст сообщения
     *
     * @return string
     */
    public function getMessage(): string
    {
        $result = '';
        $stage = $this->stage;
        $directionRus = Direction::DIRECTION_LIST_RUS[$stage->levels->direction_id];
        $level = $stage->levels->number;
        // завершение онлайн обучения
        if($stage->number == self::REQUEST_OR_LESSON_STAGE && $level == self::LEVEL1) {
            $result = sprintf(self::MESSAGE_LESSON, $directionRus);
        // завершения этапов обучения
        } else if ($stage->number == self::TEST_STAGE && $level < self::LEVEL3) {
            $result = sprintf(self::MESSAGE_TEST, $level, $directionRus);
        // Присваивания статуса эксперта
        } else if ($stage->number == self::TEST_STAGE && $level == self::LEVEL3) {
            $result = sprintf(self::MESSAGE_EXPERT, $level, $directionRus);
        // подача заявления на 2-ом уровне
        } else if ($stage->number == self::REQUEST_OR_LESSON_STAGE && $level == self::LEVEL2){
            $result = sprintf(self::MESSAGE_REQUEST_LEVEL2, $directionRus);
        // подача заявления на 3-ом уровне
        } else if ($stage->number == self::REQUEST_OR_LESSON_STAGE && $level == self::LEVEL3){
            $result = sprintf(self::MESSAGE_REQUEST_LEVEL3, $directionRus);
        // подача заявления на 2-ом уровне
        } else if ($stage->number == self::TESTING_STAGE && $level == self::LEVEL4) {
            $result = sprintf(self::MESSAGE_REQUEST_LEVEL4, $directionRus);
        }
        return $result;
    }


}