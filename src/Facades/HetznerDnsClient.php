<?php

namespace DutchCodingCompany\HetznerDnsClient\Facades;

use Illuminate\Support\Facades\Facade;
use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient as Client;

/**
 * @see \DutchCodingCompany\HetznerDnsClient\HetznerDnsClient
 */
class HetznerDnsClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}
