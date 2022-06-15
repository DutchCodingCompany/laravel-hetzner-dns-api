<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects\Casters;

use Carbon\Carbon;
use DutchCodingCompany\HetznerDnsClient\Enums\RecordType;
use Spatie\DataTransferObject\Caster;

class RecordTypeCaster implements Caster
{
    public function cast(mixed $value): ?RecordType
    {
        return empty($value) ? null : RecordType::fromValue($value);
    }
}
