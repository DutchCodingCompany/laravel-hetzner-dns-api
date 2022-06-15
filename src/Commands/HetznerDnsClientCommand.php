<?php

namespace DutchCodingCompany\HetznerDnsClient\Commands;

use Illuminate\Console\Command;

class HetznerDnsClientCommand extends Command
{
    public $signature = 'laravel-hetzner-dns-api';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
