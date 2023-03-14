<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var string
     */
    protected $userMessage;

    /**
     * Create a new notification instance.
     *
     * @param string $userMessage
     */
    public function __construct(string $userMessage)
    {
        $this->userMessage = $userMessage;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'mail',
            'database'
        ];
    }

    public function toDatabase()
    {
        return [
            'message' => $this->userMessage,
        ];
    }


    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Привет!')
                    ->line('Вам поступило уведомление.')
                    ->action('Перейти', url('/notifications'))
                    ->line('Спасибо за использование нашего приложения!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
