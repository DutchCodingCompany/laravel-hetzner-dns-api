<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\Objects\Zone;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateZone extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $name,
        protected ?int $ttl = null,
    ) {
        $this->ttl ??= config('hetzner-dns.default_ttl');
    }

    public function resolveEndpoint(): string
    {
        return '/zones';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'name' => $this->name,
            'ttl' => $this->ttl,
        ]);
    }

    public function createDtoFromResponse(Response $response): Zone
    {
        return Zone::fromArray($response->json('zone'));
    }
}
