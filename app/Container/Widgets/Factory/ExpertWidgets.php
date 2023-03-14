<?php

namespace App\Container\Widgets\Factory;


use App\Container\Widgets\Image;

class ExpertWidgets extends AbstractionFactory
{
    protected $template = FactoryWidgets::EXPERT;

    protected $isArray = true;

    /**
     * @return array
     */
    public function getDataForParam(): array
    {
        return [
            'name' => '',
            'text' => '',
            'image' => '',
        ];
    }

    /**
     * @param array $data
     * @return mixed|void
     * @throws \Exception
     */
    public function updateParams(array $data = [])
    {
        $image = $data['newImage'];
        if($image){
            foreach ($this->param as $key=>&$item) {
                if (isset($image[$key])) {
                    $file = Image::getImageFileNameImage($image[$key]);
                    $item['image'] = Image::moveImage($file);
                }
            }
        }
        Image::clearTemp();
    }

}