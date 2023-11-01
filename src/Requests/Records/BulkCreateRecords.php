<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\BulkCreatedRecords;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

class BulkCreateRecords extends SaloonRequest
{
    use HasJsonBody, CastsToDto;

    protected array $records;

    public function __construct(array $records)
    {
        $this->records = collect($records)
            ->map(function ($items) {
                return (new CreateRecord(...$items))->getData();
            })->filter()->toArray();
    }

    protected ?string $connector = HetznerDnsClient::class;

    protected ?string $method = Saloon::POST;

    public function defineEndpoint(): string
    {
        return '/records/bulk';
    }

    public function defaultData(): array
    {
        return array_filter([
            'records' => $this->records,
        ]);
    }

    protected function castToDto(SaloonResponse $response): BulkCreatedRecords
    {
        return new BulkCreatedRecords($response->json());
    }
}
