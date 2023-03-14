<?php

namespace Tests\Unit\Container\Widget;

use App\Container\Widgets\Image;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
//use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * - Получение и сохранение изображение
 * - Переместить изображение
 * - удалить не сохронёные изображение
 * - Создание виджитов Слайдер
 * - Проверить на соответствие типов
 *
 * Class WidgetTest
 * @package Tests\Unit\Container
 */
class ImageTest extends TestCase
{

    /**
     * Получение и сохранение изображение
     */
    public function testSaveImage()
    {
        $image = new UploadedFile('C:\OSPanel\domains\rybakov-font\public\images\content\cert1.jpg', 'cert1.jpg');
        $path = (new Image($image))->saveImage();
        $result = str_replace('\\', '/', Image::PATH_GET_IMAGE . Image::PATH_TEMP . time() . $image->hashName());
        $this->assertEquals($result, $path);
    }

    /**
     * Проверить на соответствие типов
     */
    public function testValid()
    {
        $image = new UploadedFile('C:\OSPanel\domains\rybakov-font\public\images\content\cert1.jpg', 'cert1.jpg');
        $this->assertTrue((new Image($image))->valid());
        $image = new UploadedFile('C:\OSPanel\domains\rybakov-font\public\images\third_level.svg', 'third_level.svg');
        $this->assertFalse((new Image($image))->valid());
    }

    /**
     * Переместить изображение
     */
    public function testMoveImage()
    {
        $imageFile = '156620637634cSUDoHK61fmGouuXalx4Eo6U6VJxFpiWyQQTcb.jpeg';
        try {
            $this->assertTrue(Image::moveImage($imageFile));
        } catch (\Exception $exception) {
            $this->assertEquals(Image::ERROR_FILE_NOT_FOUND, $exception->getMessage());
        }
    }

    /**
     * удалить не сохронёные изображение
     */
    public function testClearTemp()
    {
        $this->assertTrue(Image::clearTemp());
        $this->assertEmpty(\Storage::files(Image::PATH_TEMP));
    }
}
