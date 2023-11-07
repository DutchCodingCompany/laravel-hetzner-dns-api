<?php

namespace DutchCodingCompany\HetznerDnsClient;

use DutchCodingCompany\HetznerDnsClient\Resources\RecordResource;
use DutchCodingCompany\HetznerDnsClient\Resources\ZoneResource;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class HetznerDnsClient extends Connector
{
    use Traits\ThrowsOnErrorsExceptNotFound;
    use Traits\ResolvesApiToken;
    use AcceptsJson;

    /**
     * The Base URL of the API.
     *
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return 'https://dns.hetzner.com/api/v1';
    }

    /**
     * The headers that will be applied to every request.
     *
     * @return array<string, mixed>
     */
    public function defaultHeaders(): array
    {
        return [
            'Auth-API-Token' => self::getApiToken(),
        ];
    }

    /**
     * Collection of methods for the zone resource.
     *
     * @return \DutchCodingCompany\HetznerDnsClient\Resources\ZoneResource
     */
    public function zones(): ZoneResource
    {
        return new ZoneResource($this);
    }

    /**
     * Collection of methods for the record resource.
     *
     * @return \DutchCodingCompany\HetznerDnsClient\Resources\RecordResource
     */
    public function records(): RecordResource
    {
        return new RecordResource($this);
    }
}
