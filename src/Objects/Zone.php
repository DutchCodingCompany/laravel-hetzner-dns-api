<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use Carbon\Carbon;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\DataTransferObject;

#[
    DefaultCast(Carbon::class, Casters\CarbonCaster::class),
]
class Zone extends DataTransferObject
{
    public string $id;
    public string $name;
    public int $ttl;
    public ?string $registrar;
    public ?string $legacy_dns_host;
    public ?array $legacy_ns;
    public array $ns;
    public Carbon $created;
    public ?Carbon $verified;
    public Carbon $modified;
    public string $owner;
    public string $permission;
    public array $zone_type;
    public string $status;
    public bool $paused;
    public bool $is_secondary_dns;
    public array $txt_verification;
    public int $records_count;
}
