<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\Objects\Records;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class ListRecords extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?int $page = null,
        protected ?int $per_page = null,
        protected ?string $zone_id = null,
    ) {
    }

    public function resolveEndpoint(): string
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

    public function createDtoFromResponse(Response $response): Records
    {
        return Records::fromArray($response->json('records'));
    }
}
