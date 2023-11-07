<?php

namespace DutchCodingCompany\HetznerDnsClient\Resources;

use DutchCodingCompany\HetznerDnsClient\Objects\Zone;
use DutchCodingCompany\HetznerDnsClient\Objects\Zones;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\CreateZone;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\DeleteZone;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\ExportZone;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\GetZone;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\ListZones;
use DutchCodingCompany\HetznerDnsClient\Requests\Zones\UpdateZone;

class ZoneResource extends Resource
{
    public function all(string $name = null, ?int $per_page = null, ?string $search_name = null): ?Zones
    {
        return $this->connector->send(new ListZones(name: $name, per_page: $per_page, search_name: $search_name))->dto();
    }

    public function create(string $name, ?int $ttl = null): Zone
    {
        return $this->connector->send(new CreateZone(name: $name, ttl: $ttl))->dto();
    }

    public function get(string $zone_id): ?Zone
    {
        return $this->connector->send(new GetZone(zone_id: $zone_id))->dto();
    }

    public function getByName(string $name): ?Zone
    {
        $zones = $this->all(name: $name);

        return collect($zones?->zones)->where('name', $name)->first();
    }

    public function update(string $zone_id, string $name, ?int $ttl = null): Zone
    {
        return $this->connector->send(new UpdateZone(zone_id: $zone_id, name: $name, ttl: $ttl))->dto();
    }

    public function delete(string $zone_id): void
    {
        $this->connector->send(new DeleteZone(zone_id: $zone_id));
    }

    public function export(string $zone_id): string
    {
        return $this->connector->send(new ExportZone(zone_id: $zone_id))->body();
    }
}
