<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\Objects\Zone;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetZone extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $zone_id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/zones/'.$this->zone_id;
    }

    public function createDtoFromResponse(Response $response): Zone
    {
        return Zone::fromArray($response->json('zone'));
    }
}
