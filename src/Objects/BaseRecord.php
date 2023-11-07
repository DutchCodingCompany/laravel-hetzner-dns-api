<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use Carbon\Carbon;
use DutchCodingCompany\HetznerDnsClient\Enums\RecordType;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\DataTransferObject;

#[
    DefaultCast(Carbon::class, Casters\CarbonCaster::class),
    DefaultCast(RecordType::class, Casters\RecordTypeCaster::class),
]
class BaseRecord extends DataTransferObject
{
    public RecordType $type;

    public string $name;

    public string $value;

    public string $zone_id;
}
