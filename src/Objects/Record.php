<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use DutchCodingCompany\HetznerDnsClient\Enums\RecordType;

class Record extends BaseRecord
{
    public function __construct(
        public RecordType $type,
        public string $name,
        public string $value,
        public string $zone_id,
        public string $id,
        public CarbonInterface $created,
        public CarbonInterface $modified,
        // Hetzner does not return the ttl for a record when it is not explicitly set and uses the zone default
        public ?int $ttl = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            type: RecordType::from($data['type']),
            name: $data['name'],
            value: $data['value'],
            zone_id: $data['zone_id'],
            id: $data['id'],
            created: Carbon::make($data['created']),
            modified: Carbon::make($data['modified']),
            ttl: $data['ttl'] ?? null,
        );
    }
}
