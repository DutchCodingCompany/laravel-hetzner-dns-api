<?php

namespace DutchCodingCompany\HetznerDnsClient\Facades;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient as Client;
use Illuminate\Support\Facades\Facade;

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
