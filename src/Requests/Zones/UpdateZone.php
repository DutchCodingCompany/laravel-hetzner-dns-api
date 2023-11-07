<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Zones;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Zone;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateZone extends Request
{
    use HasJsonBody;

    public function __construct(
        protected string $zone_id,

        protected string $name,
        protected ?int $ttl = null,
    ) {
        $this->ttl ??= config('hetzner-dns.default_ttl');
    }

    protected ?string $connector = HetznerDnsClient::class;

    protected Method $method = Method::PUT;

    public function resolveEndpoint(): string
    {
        return '/zones/'.$this->zone_id;
    }

    public function defaultBody(): array
    {
        return array_filter([
            'id' => $this->zone_id,
            'name' => $this->name,
            'ttl' => $this->ttl,
        ]);
    }

    public function createDtoFromResponse(Response $response): Zone
    {
        return Zone::fromArray($response->json('zone'));
    }
}
