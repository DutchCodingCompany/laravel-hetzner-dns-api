<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class ExportZone extends Request
{
    public function __construct(
        protected string $zone_id,
    )
    {}

    protected ?string $connector = HetznerDnsClient::class;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/zones/'.$this->zone_id.'/export';
    }
}
