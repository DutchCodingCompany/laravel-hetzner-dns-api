<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Record;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\CastsToDto;

class GetRecord extends Request
{
    use CastsToDto;

    public function __construct(
        protected string $record_id,
    )
    {}

    protected ?string $connector = HetznerDnsClient::class;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/records/'.$this->record_id;
    }

    protected function castToDto(Response $response): Record
    {
        return new Record($response->json('record'));
    }
}
