<?php

namespace DutchCodingCompany\HetznerDnsClient\RequestCollections;

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
use Sammyjo20\Saloon\Http\RequestCollection;

class RecordCollection extends RequestCollection
{
    public function all(?int $page = null, ?int $per_page = null, ?string $zone_id = null): ?Records
    {
        return $this->connector->request(new ListRecords(page: $page, per_page: $per_page, zone_id: $zone_id))->send()->dto();
    }

    public function create(string $zone_id, RecordType $type, string $name, string $value, ?int $ttl = null): Record
    {
        return $this->connector->request(new CreateRecord(zone_id: $zone_id, type: $type, name: $name, value: $value, ttl: $ttl))->send()->dto();
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
        return $this->connector->request(new GetRecord(record_id: $record_id))->send()->dto();
    }

    public function update(string $record_id, string $zone_id, RecordType $type, string $name, string $value, ?int $ttl = null): Record
    {
        return $this->connector->request(new UpdateRecord(record_id: $record_id, zone_id: $zone_id, type: $type, name: $name, value: $value, ttl: $ttl))->send()->dto();
    }

    public function delete(string $record_id): void
    {
        $this->connector->request(new DeleteRecord($record_id))->send();
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
        return $this->connector->request(new BulkCreateRecords($records))->send()->dto();
    }

    public function bulkUpdate(array $records): BulkUpdatedRecords
    {
        return $this->connector->request(new BulkUpdateRecords($records))->send()->dto();
    }
}
