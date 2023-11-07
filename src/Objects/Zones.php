<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use InvalidArgumentException;

class Zones
{
    final public function __construct(
        /** @var \DutchCodingCompany\HetznerDnsClient\Objects\Zone[] */
        readonly public array $zones,
    ) {
        foreach ($zones as $zone) {
            if (! ($zone instanceof Zone)) {
                throw new InvalidArgumentException('All elements of $zones should be an instance of '.Zone::class);
            }
        }
    }

    public static function fromJsonArray(array $data): static
    {
        $zones = [];

        foreach($data as $entry) {
            $zones[] = Zone::fromJsonArray($entry);
        }

        return new static($zones);
    }
}
