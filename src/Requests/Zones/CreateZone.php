<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Zone;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

class CreateZone extends SaloonRequest
{
    use HasJsonBody, CastsToDto;

    public function __construct(
        protected string $name,
        protected ?int $ttl = null,
    )
    {}

    protected ?string $connector = HetznerDnsClient::class;

    protected ?string $method = Saloon::POST;

    public function defineEndpoint(): string
    {
        return '/zones';
    }

    public function defaultData(): array
    {
        return array_filter([
            'name' => $this->name,
            'ttl' => $this->ttl,
        ]);
    }

    protected function castToDto(SaloonResponse $response): Zone
    {
        return new Zone($response->json('zone'));
    }
}
