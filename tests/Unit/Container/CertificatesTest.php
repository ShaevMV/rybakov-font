<?php

namespace Tests\Unit\Container;

use App\Container\Certificates\CertificatesContainer;
use App\Container\Certificates\CertificatesCreate;
use App\Container\Certificates\TemplateCertificates;
use App\Container\Lesson\LessonContainer;
use App\Container\Level\LevelContainer;
use App\Container\Testing\TestingContainer;
use App\Container\Testing\TrainingsContainer;
use App\Models\Certificate;
use App\Models\Direction;
use App\User;
use Tests\TestCase;

//use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * - Получить шаблон сертификата
 * - Создать сертификат прохождения онлайн обучения и записать сертификат в базу
 * - Вывести список сертификатов пользователя
 *
 * Class CertificatesTest
 * @package Tests\Unit\Container
 */
class CertificatesTest extends TestCase
{
    /**
     * Получить шаблон сертификата
     *
     * @dataProvider directionProvider
     * @param int $directionId
     * @return void
     * @throws \Exception
     */
    public function testGetTemplate(int $directionId)
    {
        $training = new TrainingsContainer(
            User::find(1),
            (new TestingContainer(LevelContainer::getLevelByNumber(1, $directionId)))
                ->getTesting());

        $this->assertEquals((new TemplateCertificates($training))->getTemplate(), "certificates/NOKDO_1_2.png");
        $this->assertEquals((new TemplateCertificates((new LessonContainer(User::find(1), $directionId))))->getTemplate(),
            'certificates.pdfLesson');
    }

    /**
     * Получить шаблон сертификата
     *
     * @dataProvider directionProvider
     * @return void
     * @throws \Exception
     */
    public function testGetName(int $directionId)
    {
        $training = new TrainingsContainer(
            User::find(1),
            (new TestingContainer(LevelContainer::getLevelByNumber(1, $directionId)))
                ->getTesting());
        $this->assertNotEmpty((new TemplateCertificates($training))->getTemplate());
        $this->assertNotEmpty((new TemplateCertificates((new LessonContainer(User::find(1), $directionId))))->getTemplate());
    }


    /**
     * Создать сертификат прохождения онлайн обучения и записать его в базу
     *
     * @dataProvider directionProvider
     * @param $directionId
     * @throws \Exception
     */
    public function testCreatePdfLesson($directionId)
    {
        $certificates = new CertificatesCreate((new LessonContainer(User::find(1), $directionId)));
        $this->assertTrue($certificates->createPdf());
        $this->assertInstanceOf(Certificate::class, $certificates->saveToTable());
    }

    /**
     * Создать сертификат прохождения тестирования 1 уровня и записать его в базу
     *
     * @dataProvider directionProvider
     * @param $directionId
     * @throws \Exception
     */
    public function testCreatePdfTesting($directionId)
    {
        $training = new TrainingsContainer(
            User::find(1),
            (new TestingContainer(LevelContainer::getLevelByNumber(1, $directionId)))
                ->getTesting());
        $certificates = new CertificatesCreate($training);
        $this->assertTrue($certificates->createPdf());
        $this->assertInstanceOf(Certificate::class, $certificates->saveToTable());
    }

    /**
     * Вывести список сертификатов пользователя
     *
     */
    public function testGetList()
    {
        $certificates = new CertificatesContainer(User::find(1));
        $this->assertNotEmpty($certificates->getList());
    }

    public function directionProvider()
    {
        return [
            [Direction::ID_NOKDO],
            [Direction::ID_ECERS]
        ];
    }
}
