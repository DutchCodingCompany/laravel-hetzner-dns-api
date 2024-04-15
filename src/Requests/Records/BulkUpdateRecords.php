<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\Objects\BulkUpdatedRecords;
use Illuminate\Support\Arr;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class BulkUpdateRecords extends Request implements HasBody
{
    use HasJsonBody;

    protected array $records;

    protected Method $method = Method::PUT;

    public function __construct(array $records)
    {
        $this->records = collect($records)
            ->map(function ($items) {
                return array_merge(
                    (new UpdateRecord(...$items))->body()->get(),
                    ['id' => array_key_exists('record_id', $items) ? $items['record_id'] : Arr::first($items)]
                );
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

    public function createDtoFromResponse(Response $response): BulkUpdatedRecords
    {
        return BulkUpdatedRecords::fromArray($response->json());
    }
}
