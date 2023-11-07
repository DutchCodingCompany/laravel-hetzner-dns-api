<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Zone;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetZone extends Request
{
    public function __construct(
        protected string $zone_id,
    ) {
    }

    protected ?string $connector = HetznerDnsClient::class;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/zones/'.$this->zone_id;
    }

    public function createDtoFromResponse(Response $response): Zone
    {
        return Zone::fromArray($response->json('zone'));
    }
}
