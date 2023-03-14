<?php

namespace Tests\Unit\Container\Testing;

use App\Container\Testing\Question\Options\ManyType;
use App\Container\Testing\Question\Options\OptionType;
use App\Container\Testing\Question\Options\TextType;
use App\Container\Testing\Question\QuestionFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * - Получение объекта по типу вопроса
 *
 * Class QuestionFactoryTest
 * @package Tests\Unit\Container\Testing
 */
class QuestionFactoryTest extends TestCase
{
    /**
     * Получение объекта по типу вопроса
     *
     * @dataProvider factoryProvider
     *
     * @param $type
     * @param $objectClass
     * @throws \Exception
     */
    public function testObjectQuestion($type,$objectClass)
    {
        $this->assertInstanceOf($objectClass,QuestionFactory::getQuestion($type));
    }

    public function factoryProvider()
    {
        return [
            [QuestionFactory::QUESTION_OPTION_TYPE, OptionType::class],
            [QuestionFactory::QUESTION_MANY_TYPE, ManyType::class],
            [QuestionFactory::QUESTION_TEXT_TYPE, TextType::class],
        ];
    }
}
