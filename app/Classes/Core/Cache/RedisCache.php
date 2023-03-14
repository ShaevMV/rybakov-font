<?php

namespace App\Classes\Core\Cache;

use Illuminate\Support\Facades\Redis;

class RedisCache implements CacheInterface
{
    /**
     * @var Redis
     */
    private $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis::connection();
    }

    /**
     * @param string $token
     * @param string $key
     * @param callable|null $callable
     * @return mixed|null|string
     */
    public function get(string $token, string $key, callable $callable = null)
    {

        if (empty($this->redis->hget($token, $key))) {
            $result = !empty($callable) ? $callable() : null;

            $this->redis->hset($token, $key, $result);
        } else {
            $result = $this->redis->hget($token, $key);
        }
        return $result;
    }

    /**
     * Удалить данные из кеша
     *
     * @param string $token
     * @param string $key
     * @return mixed|void
     */
    public function del(string $token,string $key)
    {
        $this->redis->hdel($token,[$key]);
    }


}