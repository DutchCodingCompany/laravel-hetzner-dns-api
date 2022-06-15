<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\ZoneCollection;
use Illuminate\Support\Arr;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

class ListZones extends SaloonRequest
{
    use CastsToDto;

    public function __construct(
        protected ?string $name = null,
        protected ?int $page = null,
        protected ?int $per_page = null,
        protected ?string $search_name = null,
    )
    {}

    protected ?string $connector = HetznerDnsClient::class;

    protected ?string $method = Saloon::GET;

    public function defineEndpoint(): string
    {
        return '/zones';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'name' => $this->name,
            'page' => $this->page,
            'per_page' => $this->per_page,
            'search_name' => $this->search_name,
        ]);
    }

    protected function castToDto(SaloonResponse $response): mixed
    {

         dd(new ZoneCollection($response->json()));
    }
}
