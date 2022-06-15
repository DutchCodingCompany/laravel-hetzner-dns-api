<?php

namespace DutchCodingCompany\HetznerDnsClient\RequestCollections;

use DutchCodingCompany\HetznerDnsClient\Requests\Zones\CreateZone;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\DeleteZone;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\ExportZone;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\GetZone;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\ListZones;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\UpdateZone;
use Sammyjo20\Saloon\Http\RequestCollection;

class ZoneCollection extends RequestCollection
{
    public function all(...$arguments): array
    {
        return $this->connector->request(new ListZones(...$arguments))->send()->json();
    }

    public function create(...$arguments): array
    {
        return $this->connector->request(new CreateZone(...$arguments))->send()->json();
    }

    public function get(...$arguments): array
    {
        return $this->connector->request(new GetZone(...$arguments))->send()->json();
    }

    public function update(...$arguments): array
    {
        return $this->connector->request(new UpdateZone(...$arguments))->send()->json();
    }

    public function delete(...$arguments): array
    {
        return $this->connector->request(new DeleteZone(...$arguments))->send()->json();
    }

    public function export(...$arguments): array
    {
        return $this->connector->request(new ExportZone(...$arguments))->send()->json();
    }
}
