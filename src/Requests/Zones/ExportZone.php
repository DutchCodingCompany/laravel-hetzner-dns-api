<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use Illuminate\Support\Arr;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;

class ExportZone extends SaloonRequest
{
    public function __construct(
        protected string $zone_id,
    )
    {}

    protected ?string $connector = HetznerDnsClient::class;

    protected ?string $method = Saloon::GET;

    public function defineEndpoint(): string
    {
        return '/zones/'.$this->zone_id.'/export';
    }
}
