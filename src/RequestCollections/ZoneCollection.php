<?php

namespace DutchCodingCompany\HetznerDnsClient\RequestCollections;

use DutchCodingCompany\HetznerDnsClient\Objects\Zone;
use DutchCodingCompany\HetznerDnsClient\Objects\Zones;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\CreateZone;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\DeleteZone;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\ExportZone;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\GetZone;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\ListZones;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\UpdateZone;
use Sammyjo20\Saloon\Http\RequestCollection;

class ZoneCollection extends RequestCollection
{
    public function all(string $name = null,?int $per_page = null, ?string $search_name = null): Zones
    {
        return $this->connector->request(new ListZones(name: $name, per_page: $per_page, search_name: $search_name))->send()->throw()->dto();
    }

    public function create(string $name, ?int $ttl = null): Zone
    {
        return $this->connector->request(new CreateZone(name: $name, ttl: $ttl))->send()->throw()->dto();
    }

    public function get(string $zone_id): Zone
    {
        return $this->connector->request(new GetZone(zone_id: $zone_id))->send()->throw()->dto();
    }

    public function update(string $zone_id, string $name, ?int $ttl = null): Zone
    {
        return $this->connector->request(new UpdateZone(zone_id: $zone_id, name: $name, ttl: $ttl))->send()->throw()->dto();
    }

    public function delete(string $zone_id): void
    {
        $this->connector->request(new DeleteZone(zone_id: $zone_id))->send()->throw();
    }

    public function export(string $zone_id): string
    {
        return $this->connector->request(new ExportZone(zone_id: $zone_id))->send()->throw()->body();
    }
}
