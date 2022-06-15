<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects\Casters;

use Carbon\Carbon;
use Spatie\DataTransferObject\Caster;

class CarbonCaster implements Caster
{
    public function cast(mixed $value): ?Carbon
    {
        return empty($value) ? null : (new Carbon($value));
    }
}
