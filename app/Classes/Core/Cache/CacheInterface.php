<?php

namespace App\Classes\Core\Cache;


interface CacheInterface
{
    /**
     * Получить значения из кеша, при отсутствии записать их
     *
     * @param string $token
     * @param string $key
     * @param callable $callable
     * @return mixed
     */
    public function get(string $token, string $key, callable $callable = null);


    /**
     * Удаление значения из кеша
     *
     * @param string $token
     * @param string $key
     * @return mixed
     */
    public function del(string $token,string $key);

}