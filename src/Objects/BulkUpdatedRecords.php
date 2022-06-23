<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

class BulkUpdatedRecords extends DataTransferObject
{
    /** @var Record[] */
    #[CastWith(ArrayCaster::class, itemType: BaseRecord::class)]
    public array $failed_records;

    /** @var Record[] */
    #[CastWith(ArrayCaster::class, itemType: Record::class)]
    public array $records;
}
