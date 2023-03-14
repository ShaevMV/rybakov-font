<?php

namespace App\Container\UserMessage;


class MessageEndTesting extends UserMessage
{
    public function getModalMessage():string
    {
        switch ($this->level->number){
            case self::LEVEL_1:
                $result = "<span class='uk-text-bold'>Поздравляем!</span> Вы успешно закончили первый этап обучения по ветке «".
                    $this->directionRus."». Вам присвоен сертификат.";
                break;
            case self::LEVEL_4:
                $result = "<span class='uk-text-bold'>Поздравляем!</span> Вы успешно закончили тестирования по ветке «".
                    $this->directionRus."». На указаную вами почту был отправлен pdf с вашем тестированием.";
                break;
            default:
                $result = "Ваш тест, отправлен на проверку эксперту! В скором времени вы получите экспертное заключение.";
        }
        return $result;
    }
}