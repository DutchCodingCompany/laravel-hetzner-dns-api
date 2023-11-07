<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\Objects\Record;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetRecord extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $record_id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/records/'.$this->record_id;
    }

    public function createDtoFromResponse(Response $response): Record
    {
        return Record::fromArray($response->json('record'));
    }
}
