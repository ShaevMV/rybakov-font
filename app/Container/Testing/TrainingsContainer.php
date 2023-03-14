<?php

namespace App\Container\Testing;

use App\Container\InterfaceStage;
use App\Models\Direction;
use App\Models\Stage;
use App\Models\Testing;
use App\Models\Training;
use App\User;

class TrainingsContainer extends Trainings implements InterfaceStage
{

    /**
     * @var string
     */
    protected $classModel = Testing::class;

    /**
     * @return Stage|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|object
     */
    public function getStage()
    {
        return $this->model->level->stages()->orderByDesc('number')->first();
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Записать мнение эксперта
     *
     * @param Training $training
     * @param string $comment
     * @param int $expert_id
     * @return bool
     */
    public static function setExpertOpinion(Training $training, string $comment, int $expert_id)
    {
        return $training->update([
            'expert_opinion' => $comment,
            'expert_id' => $expert_id
        ]);
    }


    /**
     * Создать PDF файл для
     * TODO: переписать в ООП
     *
     * @param string $type
     * @return string
     * @throws \Exception
     */
    public function getPdfFile(string $type)
    {
        $fileName = '\\Testing\\Testing_'.$type.'_'.$this->getUser()->id.'_v_'.$this->getTraining()->id.'.pdf';

        if(!\Storage::disk('local')->has($fileName)){
            $listQuestion = $this->getList()->get();
            $pdf = \PDF::loadView('certificates.pdfTesting', [
                'questions' => $listQuestion,
                'directionName' => Direction::DIRECTION_LIST_RUS[Direction::getIdForName($type)],
                'description' => $this->model->description,
                'absUser' => self::getAds($listQuestion)
            ]);
            \Storage::put(
                'public'.$fileName,
                $pdf->output());
        }

        return $fileName;
    }

    /**
     * Получить средне статистический балл
     *
     * @param $listQuestion
     * @return float
     */
    public static function getAds($listQuestion): float
    {
        $sumAnswerUser = 0;
        foreach ($listQuestion as $item) {
            if(isset($item['answer_user']['answer'])){
                $answerUser = \GuzzleHttp\json_decode($item['answer_user']['answer']);
                $sumAnswerUser += array_sum($answerUser);
            } else {
                $sumAnswerUser += 0;
            }
        }
        return round($sumAnswerUser / count($listQuestion),2);
    }
}