<?php

namespace DutchCodingCompany\HetznerDnsClient\Objects;

use DutchCodingCompany\HetznerDnsClient\Exceptions\InvalidArgumentException;

/**
 * @property-read \DutchCodingCompany\HetznerDnsClient\Objects\BaseRecord[]  $failed_records
 * @property-read \DutchCodingCompany\HetznerDnsClient\Objects\Record[]  $records
 */
class BulkUpdatedRecords
{
    public function __construct(
        public readonly array $failed_records,
        public readonly array $records,
    ) {
        foreach ($failed_records as $failedRecord) {
            if (! ($failedRecord instanceof BaseRecord)) {
                throw new InvalidArgumentException('All elements of $failed_records should be an instance of '.BaseRecord::class);
            }
        }

        foreach ($records as $record) {
            if (! ($record instanceof Record)) {
                throw new InvalidArgumentException('All elements of $records should be an instance of '.Record::class);
            }
        }
    }

    public static function fromArray(array $data): self
    {
        return new self(
            failed_records: array_map(BaseRecord::fromArray(...), $data['failed_records'] ?? []),
            records: array_map(Record::fromArray(...), $data['records'] ?? []),
        );
    }
}
