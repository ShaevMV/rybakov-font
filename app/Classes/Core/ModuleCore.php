<?php

namespace App\Classes\Core;

use App\Classes\Core\Cache\CacheInterface;

abstract class ModuleCore
{
    /**
     * @var string префикс класса для кеша
     */
    protected $prefix = '';

    /**
     * @var CacheInterface;
     */
    protected $cache;

    /**
     * Получить префикс
     *
     * @return mixed|string
     */
    protected function getPrefix()
    {
        $className = explode('\\', get_class($this));
        return end($className) ?? '';
    }

    /**
     * @param string $prefix
     */
    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
        $this->prefix = $this->getPrefix();
    }

    /**
     * Получить данные из кеша по его ключу
     *
     * @param string $token
     * @param string $key
     * @return mixed
     */
    public function getCache(string $token,string $key)
    {
        return $this->cache->get($token,$this->prefix . $key);
    }

    /**
     * Записать
     *
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function setCache(string $key, $value)
    {
        return $this->cache->put($this->prefix . $key, $value);
    }

    /**
     * Удалить данные из кеша
     *
     * @param string $key
     * @return mixed
     */
    public function delCache(string $key)
    {
        return $this->cache->del($this->prefix . $key);
    }


}