<?php

namespace App\Container\Testing\Question;


use App\Container\Testing\Question\Options\ManyType;
use App\Container\Testing\Question\Options\OptionType;
use App\Container\Testing\Question\Options\TextType;


class QuestionFactory
{


    /**
     * Выдать объект вопроса
     *
     * @param string $typeQuestion
     * @return ManyType|OptionType|TextType
     * @throws \Exception
     */
    public static function getQuestion(string $typeQuestion)
    {
        switch ($typeQuestion){
            case self::QUESTION_OPTION_TYPE:
                $result = new OptionType();
                break;
            case self::QUESTION_TEXT_TYPE:
                $result = new TextType();
                break;
            case self::QUESTION_MANY_TYPE:
                $result = new ManyType();
                break;
            default:
                throw new \Exception('Неверный тип вопроса!!!');
        }

        return $result;

    }
}