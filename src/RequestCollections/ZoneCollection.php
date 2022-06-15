<?php

namespace DutchCodingCompany\HetznerDnsClient\RequestCollections;

use DutchCodingCompany\HetznerDnsClient\Objects\Zone;
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
        return $this->connector->request(new ListZones(...$arguments))->send()->throw()->dto();
    }

    public function create(...$arguments): array
    {
        return $this->connector->request(new CreateZone(...$arguments))->send()->throw()->json();
    }

    public function get(...$arguments): ?Zone
    {
        return $this->connector->request(new GetZone(...$arguments))->send()->throw()->dto();
    }

    public function update(...$arguments): array
    {
        return $this->connector->request(new UpdateZone(...$arguments))->send()->throw()->json();
    }

    public function delete(...$arguments): array
    {
        return $this->connector->request(new DeleteZone(...$arguments))->send()->throw()->json();
    }

    public function export(...$arguments): array
    {
        return $this->connector->request(new ExportZone(...$arguments))->send()->throw()->json();
    }
}
