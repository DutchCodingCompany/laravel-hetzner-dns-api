<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use Carbon\CarbonInterface;
use Carbon\Carbon;

class Zone
{
    final public function __construct(
        readonly public string $id,
        readonly public string $name,
        readonly public int $ttl,
        readonly public ?string $registrar,
        readonly public ?string $legacy_dns_host,
        readonly public ?array $legacy_ns,
        readonly public array $ns,
        readonly public CarbonInterface $created,
        readonly public ?CarbonInterface $verified,
        readonly public CarbonInterface $modified,
        readonly public string $owner,
        readonly public string $permission,
        readonly public array $zone_type,
        readonly public string $status,
        readonly public bool $paused,
        readonly public bool $is_secondary_dns,
        readonly public array $txt_verification,
        readonly public int $records_count,
    ) {}

    public static function fromJsonArray(array $data): static
    {
        return new static(
            id: $data['id'],
            name: $data['name'],
            ttl: $data['ttl'],
            registrar: $data['registrar'] ?? null,
            legacy_dns_host: $data['legacy_dns_host'] ?? null,
            legacy_ns: $data['legacy_ns'] ?? null,
            ns: $data['ns'],
            created: Carbon::parse($data['created']),
            verified: Carbon::make($data['verified'] ?? null),
            modified: Carbon::parse($data['modified']),
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
