<?php

namespace App\Container\Certificates;


use App\Container\InterfaceStage;
use App\Models\Direction;

class TemplateCertificates implements InterfaceTemplate
{
    const FOLDER = 'certificates';
    const FORMAT_FILE = '.png';

    /**
     * @var InterfaceStage
     */
    private $interfaceStage;

    public function __construct(InterfaceStage $interfaceStage)
    {
        $this->interfaceStage = $interfaceStage;
    }


    /**
     * Вывести шаблон для сертификата
     *
     * @return string
     * @throws \Exception
     */
    public function getTemplate(): string
    {
        $state = $this->interfaceStage->getStage();
        $sateNumber = $state->levels->number == 1 ? '_' . $state->number : '';
        $fileName = Direction::DIRECTION_LIST[$state->levels->direction_id] . '_' . $state->levels->number . $sateNumber;
        return  self::FOLDER . '/' . $fileName . self::FORMAT_FILE;
    }

    /**
     * Вывести название для сертификата
     *
     * @return string
     * @throws \Exception
     */
    public function getName(): string
    {
        $state = $this->interfaceStage->getStage();
        $level = $state->levels->number;

        if ($state->number == 1 && $level == 1) {
            $result = 'Сертификат участника онлайн-курса';
        } else if($state->number == 2 && $level == 1) {
            $result = 'Сертификат Мастера самооценки';
        } else if($state->number == 2 && $level == 2) {
            $result = 'Сертификат Исследователя качества';
        } else {
            $result = 'Сертификат Эксперта оценки качества';
        }
        return $result;
    }
}