<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

class Zones extends DataTransferObject
{
    /** @var Zone[] */
    #[CastWith(ArrayCaster::class, itemType: Zone::class)]
    public array $zones;
}
