<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Record;
use Illuminate\Support\Arr;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

class GetRecord extends SaloonRequest
{
    use CastsToDto;

    public function __construct(
        protected string $record_id,
    )
    {}

    protected ?string $connector = HetznerDnsClient::class;

    protected ?string $method = Saloon::GET;

    public function defineEndpoint(): string
    {
        return '/records/'.$this->record_id;
    }

    protected function castToDto(SaloonResponse $response): Record
    {
        return new Record($response->json('record'));
    }
}
