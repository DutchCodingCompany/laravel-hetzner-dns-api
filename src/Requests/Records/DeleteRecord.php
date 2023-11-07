<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteRecord extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected string $record_id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/records/'.$this->record_id;
    }
}
