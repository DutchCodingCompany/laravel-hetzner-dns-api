<?php

namespace DutchCodingCompany\HetznerDnsClient\Requests\Records;

use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

class DeleteRecord extends SaloonRequest
{
    public function __construct(
        protected string $record_id,
    )
    {}

    protected ?string $connector = HetznerDnsClient::class;

    protected ?string $method = Saloon::DELETE;

    public function defineEndpoint(): string
    {
        return '/records/'.$this->record_id;
    }
}
