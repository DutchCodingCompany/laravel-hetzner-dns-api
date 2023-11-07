<?php

namespace DutchCodingCompany\HetznerDnsClient\Resources;

use Saloon\Contracts\Connector;

abstract class Resource
{
    final public function __construct(
        readonly protected Connector $connector,
    ) {}
}
