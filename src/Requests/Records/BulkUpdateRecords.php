<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\BulkUpdatedRecords;
use Illuminate\Support\Arr;
use Saloon\Http\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class BulkUpdateRecords extends Request
{
    use HasJsonBody;

    protected array $records;

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

    protected ?string $connector = HetznerDnsClient::class;

    protected Method $method = Method::PUT;

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
