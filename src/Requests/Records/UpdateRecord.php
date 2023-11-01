<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\Enums\RecordType;
use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Record;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

class UpdateRecord extends SaloonRequest
{
    use HasJsonBody, CastsToDto;

    public function __construct(
        protected string $record_id,
        protected string $zone_id,

        protected RecordType $type,
        protected string $name,
        protected string $value,
        protected ?int $ttl = null,
    ) {}

    protected ?string $connector = HetznerDnsClient::class;

    protected ?string $method = Saloon::PUT;

    public function defineEndpoint(): string
    {
        return '/records/'.$this->record_id;
    }

    public function defaultData(): array
    {
        return array_filter([
            'zone_id' => $this->zone_id,
            'name' => $this->name,
            'type' => $this->type->value,
            'value' => $this->value,
            'ttl' => $this->ttl,
        ]);
    }

    protected function castToDto(SaloonResponse $response): Record
    {
        return new Record($response->json('record'));
    }
}
