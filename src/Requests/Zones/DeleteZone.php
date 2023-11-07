<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteZone extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected string $zone_id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/zones/'.$this->zone_id;
    }
}
