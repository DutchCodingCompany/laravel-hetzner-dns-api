<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\Objects\BulkCreatedRecords;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class BulkCreateRecords extends Request implements HasBody
{
    use HasJsonBody;

    protected array $records;

    protected Method $method = Method::POST;

    public function __construct(array $records)
    {
        $this->records = collect($records)
            ->map(function ($items) {
                return (new CreateRecord(...$items))->body()->get();
            })->filter()->toArray();
    }

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

    public function createDtoFromResponse(Response $response): BulkCreatedRecords
    {
        return BulkCreatedRecords::fromArray($response->json());
    }
}
