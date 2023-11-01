<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use Carbon\Carbon;

class Record extends BaseRecord
{
    public string $id;
    public Carbon $created;
    public Carbon $modified;
    // Hetzner does not return the ttl for a record when it is not explicitly set and uses the zone default
    public ?int $ttl = null;
}
