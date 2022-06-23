<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

class Records extends DataTransferObject
{
    /** @var Record[] */
    #[CastWith(ArrayCaster::class, itemType: Record::class)]
    public array $records;
}
