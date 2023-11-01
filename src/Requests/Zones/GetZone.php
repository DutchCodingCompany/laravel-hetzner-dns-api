<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Zone;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\CastsToDto;

class GetZone extends Request
{
    use CastsToDto;

    public function __construct(
        protected string $zone_id,
    )
    {}

    protected ?string $connector = HetznerDnsClient::class;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/zones/'.$this->zone_id;
    }

    protected function castToDto(Response $response): Zone
    {
        return new Zone($response->json('zone'));
    }
}
