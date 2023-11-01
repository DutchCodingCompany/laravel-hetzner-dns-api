<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\BulkCreatedRecords;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\CastsToDto;
use Saloon\Traits\Body\HasJsonBody;;

class BulkCreateRecords extends Request
{
    use HasJsonBody, CastsToDto;

    protected array $records;

    public function __construct(array $records)
    {
        $this->records = collect($records)
            ->map(function ($items) {
                return (new CreateRecord(...$items))->body()->get();
            })->filter()->toArray();
    }

    protected ?string $connector = HetznerDnsClient::class;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/records/bulk';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'records' => $this->records,
        ]);
    }

    protected function castToDto(Response $response): BulkCreatedRecords
    {
        return new BulkCreatedRecords($response->json());
    }
}
