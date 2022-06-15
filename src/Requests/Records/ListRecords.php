<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Records;
use Illuminate\Support\Arr;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

class ListRecords extends SaloonRequest
{
    use CastsToDto;

    public function __construct(
        protected ?int $page = null,
        protected ?int $per_page = null,
        protected ?string $zone_id = null,
    )
    {}

    protected ?string $connector = HetznerDnsClient::class;

    protected ?string $method = Saloon::GET;

    public function defineEndpoint(): string
    {
        return '/records';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'page' => $this->page,
            'per_page' => $this->per_page,
            'zone_id' => $this->zone_id,
        ]);
    }

    protected function castToDto(SaloonResponse $response): Records
    {
        return new Records($response->json());
    }
}
