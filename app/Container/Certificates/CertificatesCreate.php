<?php

namespace App\Container\Certificates;


use App\Container\InterfaceStage;
use App\Models\Certificate;
use App\Models\Direction;
use App\Models\Stage;
use App\User;

class CertificatesCreate
{
    /**
     * $var string Путь от стартовой папки
     */
    const PATH = 'public\\';

    /**
     * @var Stage
     */
    private $stageModel;
    /**
     * @var User
     */
    private $user;

    /**
     * @var InterfaceTemplate
     */
    private $templateCertificates;

    public function __construct(InterfaceStage $interfaceStage)
    {
        $this->stageModel = $interfaceStage->getStage();
        $this->user = $interfaceStage->getUser();
        $this->templateCertificates = new TemplateCertificates($interfaceStage);
    }

    /**
     * Вывести имя файла
     *
     * @return string
     */
    private function getFileName(): string
    {
        return 'Certificates\\' . Direction::DIRECTION_LIST[$this->stageModel->levels->direction_id] . '\\' . $this->user->id .
            '\certificates_level_' . $this->stageModel->number .
            '_' . $this->stageModel->levels->number . '.pdf';
    }


    /**
     * Создать PDF файл
     *
     * @return bool
     * @throws \Exception
     */
    public function createPdf(): bool
    {
        $pdf = \PDF::loadView('certificates.pdfLevel', [
            'image' => $this->templateCertificates->getTemplate(),
            'name' => $this->user->name,
            'date' => date('d.m.Y')
        ]);
        return \Storage::put(
            self::PATH . $this->getFileName(),
            $pdf->output());
    }

    /**
     * Сохранить тиолько новый сертификат в таблицу
     *
     * @return bool
     */
    public function saveToTable(): bool
    {
        $isExists = Certificate::where([
            'user_id' => $this->user->id,
            'stage_id' => $this->stageModel->id
        ])->exists();
        if(!$isExists){
            Certificate::updateOrCreate([
                'pdf' => '/storage/' . str_ireplace('\\', '/', $this->getFileName()),
                'title' => $this->templateCertificates->getName(),
                'user_id' => $this->user->id,
                'stage_id' => $this->stageModel->id
            ]);
        }
        return !$isExists;
    }
}