<?php

namespace App\Mail;

use App\Models\PasswordResets;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPasswordResets extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $token = md5($this->user->email);

        $activationLink = url("/passwordResets/".$token);

        PasswordResets::updateOrCreate([
            'email' => $this->user->email,
            'token' => $token
        ]);

        return $this->view('email.passwordResets',[
            'link' => $activationLink
        ]);
    }
}
