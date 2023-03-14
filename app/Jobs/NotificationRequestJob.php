<?php

namespace App\Jobs;

use App\Container\Notification\CreateNotification;
use App\Container\Notification\NotificationMessageRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotificationRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var int
     */
    protected $idRequest;
    /**
     * @var string
     */
    protected $typeUpdate;
    /**
     * @var int
     */
    protected $userId;
    /**
     * @var string
     */
    protected $email;

    /**
     * Create a new job instance.
     *
     * @param int $idRequest
     * @param string $typeUpdate
     */
    public function __construct(int $userId, int $idRequest, string $typeUpdate, string $email)
    {
        $this->idRequest = $idRequest;
        $this->typeUpdate = $typeUpdate;
        $this->userId = $userId;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notificationMessage = new NotificationMessageRequest($this->idRequest, $this->typeUpdate);
        if($notification = CreateNotification::getNotification($this->userId, $notificationMessage, $this->email)){
            $notification->set();
            $notification->setMail();
        };

    }
}
