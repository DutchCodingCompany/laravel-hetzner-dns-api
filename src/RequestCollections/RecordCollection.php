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
    public function all(?int $page = null, ?int $per_page = null, ?string $zone_id = null): Records
    {
        return $this->connector->request(new ListRecords(page: $page, per_page: $per_page, zone_id: $zone_id))->send()->throw()->dto();
    }

    public function create(string $zone_id, RecordType $type, string $name, string $value, ?int $ttl = null): Record
    {
        return $this->connector->request(new CreateRecord(zone_id: $zone_id, type: $type, name: $name, value: $value, ttl: $ttl))->send()->throw()->dto();
    }

    public function get(string $record_id): Record
    {
        return $this->connector->request(new GetRecord(record_id: $record_id))->send()->throw()->dto();
    }

    public function update(string $record_id, string $zone_id, RecordType $type, string $name, string $value, ?int $ttl = null): Record
    {
        return $this->connector->request(new UpdateRecord(record_id: $record_id, zone_id: $zone_id, type: $type, name: $name, value: $value, ttl: $ttl))->send()->throw()->dto();
    }

    public function delete(string $record_id): void
    {
        $this->connector->request(new DeleteRecord($record_id))->send()->throw();
    }

    public function bulkCreate(array $records): BulkCreatedRecords
    {
        return $this->connector->request(new BulkCreateRecords($records))->send()->throw()->dto();
    }

    public function bulkUpdate(array $records): BulkUpdatedRecords
    {
        return $this->connector->request(new BulkUpdateRecords($records))->send()->throw()->dto();
    }
}
