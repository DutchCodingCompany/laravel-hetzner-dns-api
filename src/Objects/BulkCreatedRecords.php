<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use DutchCodingCompany\HetznerDnsClient\Exceptions\InvalidArgumentException;

/**
 * @property-read \DutchCodingCompany\HetznerDnsClient\Objects\BaseRecord[]  $invalid_records
 * @property-read \DutchCodingCompany\HetznerDnsClient\Objects\Record[]  $records
 * @property-read \DutchCodingCompany\HetznerDnsClient\Objects\BaseRecord[]  $valid_records
 */
class BulkCreatedRecords
{
    public function __construct(
        public readonly array $invalid_records,
        public readonly array $records,
        public readonly array $valid_records,
    ) {
        foreach ($invalid_records as $invalidRecord) {
            if (! ($invalidRecord instanceof BaseRecord)) {
                throw new InvalidArgumentException('All elements of $invalid_records should be an instance of '.BaseRecord::class);
            }
        }

        foreach ($records as $record) {
            if (! ($record instanceof Record)) {
                throw new InvalidArgumentException('All elements of $records should be an instance of '.Record::class);
            }
        }

        foreach ($valid_records as $validRecord) {
            if (! ($validRecord instanceof BaseRecord)) {
                throw new InvalidArgumentException('All elements of $valid_records should be an instance of '.BaseRecord::class);
            }
        }
    }

    public static function fromArray(array $data): self
    {
        return new self(
            invalid_records: array_map(BaseRecord::fromArray(...), $data['invalid_records'] ?? []),
            records: array_map(Record::fromArray(...), $data['records'] ?? []),
            valid_records: array_map(BaseRecord::fromArray(...), $data['valid_records'] ?? []),
        );
    }
}
