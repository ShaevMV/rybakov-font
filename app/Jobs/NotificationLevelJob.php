<?php

namespace App\Jobs;

use App\Container\Notification\CreateNotification;
use App\Container\Notification\NotificationMessageLevel;
use App\Models\Stage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotificationLevelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var int
     */
    protected $userId;
    /**
     * @var int
     */
    protected $idStage;



    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $userId, int $idStage)
    {
        $this->userId = $userId;
        $this->idStage = $idStage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // создать уведомление для пользователя
        if($notificationContainer = CreateNotification::getNotification(
            $this->userId,
            new NotificationMessageLevel(Stage::find($this->idStage))
        )){
            $notificationContainer->set();
            $notificationContainer->setMail();
        }
    }
}
