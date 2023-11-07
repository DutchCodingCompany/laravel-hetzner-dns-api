<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\Objects\Zones;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class ListZones extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?string $name = null,
        protected ?int $page = null,
        protected ?int $per_page = null,
        protected ?string $search_name = null,
    ) {
    }

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
