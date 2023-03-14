<?php

namespace App\Container\Widgets;


use Illuminate\Http\UploadedFile;

class Image
{

    /**
     * @var UploadedFile
     */
    private $image;

    public function __construct(UploadedFile $image)
    {
        $this->image = $image;
    }

    /**
     * @var string папка для загрузки изображений
     */
    const PATH_IMAGE = 'public\\image\\';

    /**
     * @var string папка для получения изображений
     */
    const PATH_GET_IMAGE = '\\storage\\image\\';

    /**
     * @var string папка для временной загрузки изображений
     */
    const PATH_TEMP = 'temp\\';

    /**
     * @var string Вывести сообщение об ошибке, что файл не найден
     */
    const ERROR_FILE_NOT_FOUND = 'File not found!!!';

    /**
     * @var string Вывести сообщение об ошибке, что файл не перемещен
     */
    const ERROR_FILE_NOT_MOVE = 'File not move!!!';

    /**
     * @var string Вывести сообщение об ошибке, что файл не найден
     */
    const ERROR_FILE_NOT_TYPE = 'Не верный тип файла!!!';

    /**
     * Проверить на наличие верного типа
     *
     * @return bool
     */
    public function valid(): bool
    {
        return strripos($this->image->getMimeType(),'image') !== false;
    }

    /**
     * Сохранить
     *
     * @param bool $tempPath
     * @return string
     */
    public function saveImage($tempPath = true): string
    {
        $result = time() . $this->image->hashName();
        $path =  $tempPath ? self::PATH_TEMP : '';
        \Storage::putFileAs(
            self::PATH_IMAGE . $path,
            $this->image,
            $result);

        return str_replace('\\', '/', self::PATH_GET_IMAGE . $path. $result);
    }

    /**
     * Переместить изображение
     *
     * @param string $fileImage
     * @return string
     * @throws \Exception
     */
    public static function moveImage(string $fileImage): string
    {
        if (\Storage::exists(self::PATH_IMAGE . self::PATH_TEMP . $fileImage)) {
            if(\Storage::move(self::PATH_IMAGE . self::PATH_TEMP . $fileImage, self::PATH_IMAGE . $fileImage)){
                return str_replace('\\', '/', self::PATH_GET_IMAGE . $fileImage);
            } else {
                throw new \Exception(self::ERROR_FILE_NOT_MOVE);
            }
        } else {
            throw new \Exception(self::ERROR_FILE_NOT_FOUND);
        }
    }

    /**
     * Вывести название файла
     *
     * @param string $fileImage
     * @return string
     */
    public static function getImageFileNameImage(string $fileImage):string
    {
        $needle = strripos($fileImage,'/');
        return substr($fileImage,$needle+1);
    }

    /**
     * Очистить временную папку
     *
     * @return bool
     */
    public static function clearTemp(): bool
    {
        \Storage::deleteDirectory(self::PATH_IMAGE. self::PATH_TEMP);
        return \Storage::makeDirectory(self::PATH_IMAGE. self::PATH_TEMP);
    }
}