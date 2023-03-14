<?php

namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;

use Illuminate\Container\Container;
use App\Classes\Core\Cache\CacheInterface;
use App\Classes\Core\Cache\RedisCache;
use App\Container\Token\TokenContainer;
class TokenController extends Controller
{


    /**
     * @var string Сообщение об ошибке
     */
    const ERROR_TOKEN_NOT_FOUND = 'Token not found';

    /**
     * @return mixed
     */
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getToken()
    {
        $container = Container::getInstance();
        $container->bind(CacheInterface::class, RedisCache::class);
        $token = $container->make(TokenContainer::class);



        return $result = response()->json([
            'token' => $token->getToken()
        ], 200);
    }
}
