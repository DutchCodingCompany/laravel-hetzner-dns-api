<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\Enums\RecordType;
use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Record;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateRecord extends Request
{
    use HasJsonBody;

    public function __construct(
        protected string $zone_id,

        protected RecordType $type,
        protected string $name,
        protected string $value,
        protected ?int $ttl = null,
    ) {
    }

    protected ?string $connector = HetznerDnsClient::class;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/records';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'zone_id' => $this->zone_id,
            'type' => $this->type->value,
            'name' => $this->name,
            'value' => $this->value,
            'ttl' => $this->ttl,
        ]);
    }

    public function createDtoFromResponse(Response $response): Record
    {
        return Record::fromArray($response->json('record'));
    }
}
