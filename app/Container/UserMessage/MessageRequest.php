<?php

namespace App\Container\UserMessage;


class MessageRequest extends UserMessage
{
    public function getModalMessage(): string
    {
        return "<span class='uk-text-bold'>Ваша заявка принята!</span> В ближайшее время мы с Вами свяжемся";
    }
}