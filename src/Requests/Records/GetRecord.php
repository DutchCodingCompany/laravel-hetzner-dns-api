<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use DutchCodingCompany\HetznerDnsClient\Objects\Record;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetRecord extends Request
{
    public function __construct(
        protected string $record_id,
    ) {
    }

    protected ?string $connector = HetznerDnsClient::class;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/records/'.$this->record_id;
    }

    public function createDtoFromResponse(Response $response): Record
    {
        return Record::fromArray($response->json('record'));
    }
}
