<?php

namespace DutchCodingCompany\HetznerDnsClient;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use DutchCodingCompany\HetznerDnsClient\Commands\HetznerDnsClientCommand;

class HetznerDnsClientServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-hetzner-dns-api')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-hetzner-dns-api_table')
            ->hasCommand(HetznerDnsClientCommand::class);
    }
}
