<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\Enums\RecordType;
use DutchCodingCompany\HetznerDnsClient\Objects\Record;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateRecord extends Request
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected string $record_id,
        protected string $zone_id,

        protected RecordType $type,
        protected string $name,
        protected string $value,
        protected ?int $ttl = null,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/records/'.$this->record_id;
    }

    public function defaultBody(): array
    {
        return array_filter([
            'zone_id' => $this->zone_id,
            'name' => $this->name,
            'type' => $this->type->value,
            'value' => $this->value,
            'ttl' => $this->ttl,
        ]);
    }

    public function createDtoFromResponse(Response $response): Record
    {
        return Record::fromArray($response->json('record'));
    }
}
