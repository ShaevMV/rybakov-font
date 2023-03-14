<?php

namespace App\Jobs;

use App\Container\Progress\ProgressContainer;
use App\Container\Testing\TrainingsContainer;
use App\Models\Direction;
use App\Models\Testing;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class PushTestingInEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    protected $idTesting;
    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    private $userId;

    /**
     * Create a new job instance.
     *
     * @param string $type
     * @param int $idTesting
     * @param int $userId
     */
    public function __construct(string $type, int $idTesting, int $userId)
    {
        $this->idTesting = $idTesting;
        $this->type = $type;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Exception
     */
    public function handle()
    {
        $user = User::find($this->userId);
        /** @var TrainingsContainer $trainings */
        $trainings = Container::getInstance()
            ->make(TrainingsContainer::class, [
                'user' => $user,
                'model' => Testing::find($this->idTesting)
            ]);
        // закрытие прохождения теста
        $trainings->complete();
        // запись прогресса
        ProgressContainer::complete($trainings);

        // отправка емайла
        $file = '\\storage'.$trainings->getPdfFile($this->type);
        if (config('app.env') !== 'dev') {
            $file = str_replace('\\', '/', $file);
        }
        $email = [
            ['item' => env('MAIL_FOR_TESTING')],
            ['item' => $user->email]
        ];
        Mail::send('email.testingAnswers', [
            'direction' => Direction::DIRECTION_LIST_RUS[
                Direction::getIdForName($this->type)
            ]
        ], function (Message $message) use ($email, $file, $trainings) {
            foreach ($email as $item){
                if(!empty($item['item'])){
                    $message->to($item['item'])->subject('Ответы на тест');
                    $fileContents = base64_encode(\File::get(public_path() . $file));

                    $message->attachData(base64_decode($fileContents),
                        'testing.pdf',[
                            'mime' => 'application/pdf',
                        ]);
                }
            }
        });
    }
}
