<?php

namespace DutchCodingCompany\HetznerDnsClient\Resources;

use DutchCodingCompany\HetznerDnsClient\Enums\RecordType;
use DutchCodingCompany\HetznerDnsClient\Objects\BulkCreatedRecords;
use DutchCodingCompany\HetznerDnsClient\Objects\BulkUpdatedRecords;
use DutchCodingCompany\HetznerDnsClient\Objects\Record;
use DutchCodingCompany\HetznerDnsClient\Objects\Records;
use DutchCodingCompany\HetznerDnsClient\Requests\Records\BulkCreateRecords;
use DutchCodingCompany\HetznerDnsClient\Requests\Records\BulkUpdateRecords;
use DutchCodingCompany\HetznerDnsClient\Requests\Records\CreateRecord;
use DutchCodingCompany\HetznerDnsClient\Requests\Records\DeleteRecord;
use DutchCodingCompany\HetznerDnsClient\Requests\Records\GetRecord;
use DutchCodingCompany\HetznerDnsClient\Requests\Records\ListRecords;
use DutchCodingCompany\HetznerDnsClient\Requests\Records\UpdateRecord;

class RecordResource extends Resource
{
    public function all(?int $page = null, ?int $per_page = null, ?string $zone_id = null): ?Records
    {
        return $this->connector->send(new ListRecords(page: $page, per_page: $per_page, zone_id: $zone_id))->dto();
    }

    public function create(string $zone_id, RecordType $type, string $name, string $value, ?int $ttl = null): Record
    {
        return $this->connector->send(new CreateRecord(zone_id: $zone_id, type: $type, name: $name, value: $value, ttl: $ttl))->dto();
    }

    public function createNameserverRecords(string $zone_id)
    {
        $records = [];
        $nameservers = array_filter(config('hetzner-dns.nameservers', []));
        foreach ($nameservers as $nameserver) {
            $records[] = $this->create($zone_id, RecordType::NS, '@', $nameserver);
        }

        return new Records(records: $records);
    }

    public function createIfNotExists(string $zone_id, RecordType $type, string $name, string $value, ?int $ttl = null): Record
    {
        $records = $this->all(zone_id: $zone_id);
        $record = collect($records->records)
            ->firstWhere(fn (Record $record) => $record->name === $name && $record->type === $type);

        if (! is_null($record)) {
            return $record; // already exists
        }

        return $this->create($zone_id, $type, $name, $value, $ttl);
    }

    public function createOrUpdate(string $zone_id, RecordType $type, string $name, string $value, ?int $ttl = null): Record
    {
        $records = $this->all(zone_id: $zone_id);
        $record = collect($records->records)
            ->firstWhere(fn (Record $record) => $record->name === $name && $record->type === $type);

        if (! is_null($record)) {
            // already exists, update if changed
            if ($value !== $record->value || $ttl !== $record->ttl) {
                $record = $this->update($record->id, $zone_id, $type, $name, $value, $ttl);
            }
            return $record;
        }

        return $this->create($zone_id, $type, $name, $value, $ttl);
    }

    public function get(string $record_id): Record
    {
        return $this->connector->send(new GetRecord(record_id: $record_id))->dto();
    }

    public function update(string $record_id, string $zone_id, RecordType $type, string $name, string $value, ?int $ttl = null): Record
    {
        return $this->connector->send(new UpdateRecord(record_id: $record_id, zone_id: $zone_id, type: $type, name: $name, value: $value, ttl: $ttl))->dto();
    }

    public function delete(string $record_id): void
    {
        $this->connector->send(new DeleteRecord($record_id));
    }

    public function deleteIfExists(string $zone_id, RecordType $type, string $name): bool
    {
        $records = $this->all(zone_id: $zone_id);
        $record = collect($records->records)
            ->firstWhere(fn (Record $record) => $record->name === $name && $record->type === $type);

        if (! is_null($record)) {
            $this->delete($record->id);

            return true;
        }

        return false;
    }

    public function bulkCreate(array $records): BulkCreatedRecords
    {
        return $this->connector->send(new BulkCreateRecords($records))->dto();
    }

    public function bulkUpdate(array $records): BulkUpdatedRecords
    {
        return $this->connector->send(new BulkUpdateRecords($records))->dto();
    }
}
