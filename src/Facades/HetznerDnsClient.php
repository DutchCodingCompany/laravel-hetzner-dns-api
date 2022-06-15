<?php

namespace DutchCodingCompany\HetznerDnsClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DutchCodingCompany\HetznerDnsClient\HetznerDnsClient
 */
class HetznerDnsClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-hetzner-dns-api';
    }
}
