<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteRecord extends Request
{
    public function __construct(
        protected string $record_id,
    ) {
    }

    protected ?string $connector = HetznerDnsClient::class;

    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return '/records/'.$this->record_id;
    }
}
