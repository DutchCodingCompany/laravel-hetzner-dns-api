<?php

namespace DutchCodingCompany\HetznerDnsClient;

use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;
use Sammyjo20\Saloon\Traits\Plugins\AlwaysThrowsOnErrors;

/**
 * @method RequestCollections\ZoneCollection zones()
 * @method RequestCollections\RecordCollection records()
 */
class HetznerDnsClient extends SaloonConnector
{
    use AcceptsJson, AlwaysThrowsOnErrors;
    use Traits\ResolvesApiToken;

    protected array $requests = [
        'zones' => RequestCollections\ZoneCollection::class,
        'records' => RequestCollections\RecordCollection::class,
    ];

    /**
     * The Base URL of the API.
     *
     * @return string
     */
    public function defineBaseUrl(): string
    {
        return 'https://dns.hetzner.com/api/v1';
    }

    /**
     * The headers that will be applied to every request.
     *
     * @return string[]
     */
    public function defaultHeaders(): array
    {
        return [
            'Auth-API-Token' => self::getApiToken(),
        ];
    }
}
