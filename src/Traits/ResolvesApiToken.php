<?php

namespace DutchCodingCompany\HetznerDnsClient\Traits;

use Closure;

trait ResolvesApiToken
{
    /** @var callable|string|null */
    protected static $apiTokenResolver = null;

    /**
     * @param callable|string|null $callback
     * @return void
     */
    public static function resolveApiTokenUsing($callback): void
    {
        static::$apiTokenResolver = $callback;
    }

    public static function defaultApiTokenResolver(): Closure
    {
        return fn () => config('hetzner-dns.api_token');
    }

    public static function getApiToken(): ?string
    {
        return app()->call(static::$apiTokenResolver ?? static::defaultApiTokenResolver());
    }
}
