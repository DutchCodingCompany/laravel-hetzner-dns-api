<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use Illuminate\Support\Arr;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;

class ListZones extends SaloonRequest
{
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
}
