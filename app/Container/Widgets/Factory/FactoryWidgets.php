<?php

namespace App\Container\Widgets\Factory;


class FactoryWidgets
{
    const SLIDER = 'slider';
    const PARTICIPATION = 'participation';
    const WORK = 'work';
    const TOOLS = 'tools';
    const SPONSOR = 'sponsor';
    const TALKING = 'talking';
    const YOU_TUBE = 'youTube';
    const EXPERT = 'experts';
    const REVIEWS = 'reviews';

    /**
     * @param string $template
     * @return AbstractionFactory
     * @throws \Exception
     */
    public static function getWidget(string $template): AbstractionFactory
    {
        switch ($template) {
            case self::SLIDER:
                $result = new SliderWidgets();
                break;
            case self::PARTICIPATION:
                $result = new ParticipationWidgets();
                break;
            case self::WORK:
                $result = new WorkWidgets();
                break;
            case self::TOOLS:
                $result = new ToolsWidgets();
                break;
            case self::SPONSOR:
                $result = new SponsorWidgets();
                break;
            case self::TALKING:
                $result = new TalkingWidgets();
                break;
            case self::YOU_TUBE:
                $result = new YouTubeWidgets();
                break;
            case self::EXPERT:
                $result = new ExpertWidgets();
                break;
            case self::REVIEWS:
                $result = new ReviewsWidgets();
                break;
            default:
                throw new \Exception('Widgets template not found !!!');
        }

        return $result;
    }

}