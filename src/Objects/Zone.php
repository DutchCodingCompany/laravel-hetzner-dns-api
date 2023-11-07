<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use InvalidArgumentException;

class Zone
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly int $ttl,
        public readonly ?string $registrar,
        public readonly ?string $legacy_dns_host,
        public readonly ?array $legacy_ns,
        public readonly array $ns,
        public readonly CarbonInterface $created,
        public readonly ?CarbonInterface $verified,
        public readonly CarbonInterface $modified,
        public readonly string $owner,
        public readonly string $permission,
        public readonly array $zone_type,
        public readonly string $status,
        public readonly bool $paused,
        public readonly bool $is_secondary_dns,
        public readonly array $txt_verification,
        public readonly int $records_count,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            ttl: $data['ttl'],
            registrar: $data['registrar'] ?? null,
            legacy_dns_host: $data['legacy_dns_host'] ?? null,
            legacy_ns: $data['legacy_ns'] ?? null,
            ns: $data['ns'],
            created: Carbon::make($data['created']) ?? throw new InvalidArgumentException('Attribute "created" is required on a zone.'),
            verified: Carbon::make($data['verified'] ?? null),
            modified: Carbon::make($data['modified']) ?? throw new InvalidArgumentException('Attribute "created" is required on a zone.'),
            owner: $data['owner'],
            permission: $data['permission'],
            zone_type: $data['zone_type'],
            status: $data['status'],
            paused: $data['paused'],
            is_secondary_dns: $data['is_secondary_dns'],
            txt_verification: $data['txt_verification'],
            records_count: $data['records_count'],
        );
    }
}
