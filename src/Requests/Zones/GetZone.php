<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Zone;
use Illuminate\Support\Arr;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

class GetZone extends SaloonRequest
{
    use CastsToDto;

    public function __construct(
        protected string $zone_id,
    )
    {}

    protected ?string $connector = HetznerDnsClient::class;

    protected ?string $method = Saloon::GET;

    public function defineEndpoint(): string
    {
        return '/zones/'.$this->zone_id;
    }

    protected function castToDto(SaloonResponse $response): Zone
    {
        return new Zone($response->json('zone'));
    }
}
