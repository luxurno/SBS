<?php

declare(strict_types = 1);

namespace App\Core\Cache;

use Illuminate\Support\Facades\Redis;
use Psr\SimpleCache\CacheInterface;

class RedisClient implements CacheInterface, DefaultTtlInterface
{
    private const HOUR = 3600;

    public function get($key, $default = null)
    {
        return Redis::get($key, $default);
    }

    public function set($key, $value, $ttl = null)
    {
        Redis::set($key, $value, $ttl ? $ttl : $this->getDefaultTtl());

        return true;
    }

    public function delete($key)
    {
        return Redis::forget($key);
    }

    public function clear()
    {
        return Redis::flush();
    }

    public function getMultiple($keys, $default = null)
    {
        return Redis::many($keys);
    }

    public function setMultiple($values, $ttl = null)
    {
        Redis::putMany($values, $ttl ? $ttl : $this->getDefaultTtl());

        return true;
    }

    public function deleteMultiple($keys)
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }
    }

    public function has($key)
    {
        return Redis::has($key);
    }

    public function getDefaultTtl(): int
    {
        return self::HOUR;
    }
}
