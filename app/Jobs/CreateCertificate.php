<?php

namespace App\Jobs;

use App\Container\Certificates\CertificatesCreate;
use App\Container\InterfaceStage;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCertificate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var InterfaceStage
     */
    protected $interfaceStage;

    /**
     * @var User
     */
    protected $user;

    /**
     * CreateCertifecate constructor.
     * @param InterfaceStage $interfaceStage
     */
    public function __construct(InterfaceStage $interfaceStage)
    {
        $this->interfaceStage = $interfaceStage;
    }


    /**
     * @throws \Exception
     */
    public function handle()
    {
        $certificate = new CertificatesCreate($this->interfaceStage);
        if($certificate->saveToTable()){
            $certificate->createPdf();
        }
    }
}
