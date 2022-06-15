<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use Carbon\Carbon;
use DutchCodingCompany\HetznerDnsClient\Enums\RecordType;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\DataTransferObject;

class Record extends BaseRecord
{
    public string $id;
    public Carbon $created;
    public Carbon $modified;
}
