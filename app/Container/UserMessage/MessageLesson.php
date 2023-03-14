<?php

namespace App\Container\UserMessage;


class MessageLesson extends UserMessage
{
    public function getModalMessage(): string
    {
        return "<span class='uk-text-bold'>Поздравляем!</span>  Вы закончили онлайн обучение по ветке ".$this->directionRus."
                можете продолжить обучение ";
    }
}