<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use DutchCodingCompany\HetznerDnsClient\Exceptions\InvalidArgumentException;

/**
 * @property-read \DutchCodingCompany\HetznerDnsClient\Objects\Record[]  $records
 */
class Records
{
    public function __construct(
        public readonly array $records,
    ) {
        foreach ($records as $record) {
            if (! ($record instanceof Record)) {
                throw new InvalidArgumentException('All elements of $records should be an instance of '.Record::class);
            }
        }
    }

    public static function fromArray(array $data): self
    {
        return new self(
            array_map(Record::fromArray(...), $data),
        );
    }
}
