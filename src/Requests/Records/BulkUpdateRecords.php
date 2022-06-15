<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\BulkUpdatedRecords;
use Illuminate\Support\Arr;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

class BulkUpdateRecords extends SaloonRequest
{
    use HasJsonBody, CastsToDto;

    protected array $records;

    public function __construct(array $records)
    {
        $this->records = collect($records)
            ->map(function ($items) {
                return array_merge(
                    (new UpdateRecord(...$items))->getData(),
                    ['id' => array_key_exists('record_id', $items) ? $items['record_id'] : Arr::first($items)]
                );
            })->filter()->toArray();
    }

    protected ?string $connector = HetznerDnsClient::class;

    protected ?string $method = Saloon::PUT;

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

    protected function castToDto(SaloonResponse $response): BulkUpdatedRecords
    {
        return new BulkUpdatedRecords($response->json());
    }
}
