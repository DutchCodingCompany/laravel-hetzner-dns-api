<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use DutchCodingCompany\HetznerDnsClient\Enums\RecordType;
use DutchCodingCompany\HetznerDnsClient\Exceptions\InvalidArgumentException;

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
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            type: RecordType::from($data['type']),
            name: $data['name'],
            value: $data['value'],
            zone_id: $data['zone_id'],
            id: $data['id'],
            created: Carbon::make($data['created']) ?? throw new InvalidArgumentException('Attribute "created" is required on a record.'),
            modified: Carbon::make($data['modified']) ?? throw new InvalidArgumentException('Attribute "modified" is required on a record.'),
            ttl: $data['ttl'] ?? null,
        );
    }
}
