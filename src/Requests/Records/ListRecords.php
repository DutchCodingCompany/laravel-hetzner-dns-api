<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Records;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\CastsToDto;

class ListRecords extends Request
{
    use CastsToDto;

    public function __construct(
        protected ?int $page = null,
        protected ?int $per_page = null,
        protected ?string $zone_id = null,
    )
    {}

    protected ?string $connector = HetznerDnsClient::class;

    protected Method $method = Method::GET;

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

    protected function castToDto(Response $response): Records
    {
        return new Records($response->json());
    }
}
