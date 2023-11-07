<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use DutchCodingCompany\HetznerDnsClient\Exceptions\InvalidArgumentException;

/**
 * @property-read \DutchCodingCompany\HetznerDnsClient\Objects\Zone[]  $zones
 */
class Zones
{
    public function __construct(
        public readonly array $zones,
    ) {
        foreach ($zones as $zone) {
            if (! ($zone instanceof Zone)) {
                throw new InvalidArgumentException('All elements of $zones should be an instance of '.Zone::class);
            }
        }
    }

    public static function fromArray(array $data): self
    {
        return new self(
            array_map(Zone::fromArray(...), $data),
        );
    }
}
