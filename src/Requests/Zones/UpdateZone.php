<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Zone;
use Illuminate\Support\Arr;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

class UpdateZone extends SaloonRequest
{
    use HasJsonBody, CastsToDto;

    public function __construct(
        protected string $zone_id,

        protected string $name,
        protected ?int $ttl = null,
    )
    {}

    protected ?string $connector = HetznerDnsClient::class;

    protected ?string $method = Saloon::PUT;

    public function defineEndpoint(): string
    {
        return '/zones/'.$this->zone_id;
    }

    public function defaultData(): array
    {
        return array_filter([
            'id' => $this->zone_id,
            'name' => $this->name,
            'ttl' => $this->ttl,
        ]);
    }

    protected function castToDto(SaloonResponse $response): Zone
    {
        return new Zone($response->json('zone'));
    }
}
