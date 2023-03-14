<?php

namespace App\Http\Controllers\Api\v1;

use App\Container\Certificates\CertificatesContainer;
use App\Http\Controllers\Controller;
use Illuminate\Container\Container;

class CertificateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Вывести список сертификатов
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        $certificate = Container::getInstance()->make(
            CertificatesContainer::class, [
            'user' => \Auth::user()
        ]);
        return response()->json($certificate->getList());
    }

    /**
     * Вывести список сертификатов
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexAll()
    {
        return response()->json(CertificatesContainer::getAllList()->get());
    }

}
