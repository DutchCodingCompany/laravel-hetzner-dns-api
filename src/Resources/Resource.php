<?php

namespace DutchCodingCompany\HetznerDnsClient\Resources;

use Saloon\Http\Connector;

abstract class Resource
{
    final public function __construct(
        readonly protected Connector $connector,
    ) {
    }
}
