<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use DutchCodingCompany\HetznerDnsClient\Enums\RecordType;

class BaseRecord
{
    public function __construct(
        public RecordType $type,
        public string $name,
        public string $value,
        public string $zone_id,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            type: RecordType::from($data['type']),
            name: $data['name'],
            value: $data['value'],
            zone_id: $data['zone_id'],
        );
    }
}
