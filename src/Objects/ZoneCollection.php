<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use Carbon\Carbon;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

#[
    DefaultCast(Carbon::class, Casters\CarbonCaster::class),
]
class ZoneCollection extends DataTransferObject
{
    /** @var Zone[] */
    #[CastWith(ArrayCaster::class, itemType: Zone::class)]
    public array $zones;
}
