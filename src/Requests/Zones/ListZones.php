<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Zones;
use Saloon\Http\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class ListZones extends Request
{
    public function __construct(
        protected ?string $name = null,
        protected ?int $page = null,
        protected ?int $per_page = null,
        protected ?string $search_name = null,
    ) {
    }

    protected ?string $connector = HetznerDnsClient::class;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
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

    public function createDtoFromResponse(Response $response): Zones
    {
        return Zones::fromArray($response->json('zones'));
    }
}
