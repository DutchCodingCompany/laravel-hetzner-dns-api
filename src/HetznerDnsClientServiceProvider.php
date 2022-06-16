<?php

namespace DutchCodingCompany\HetznerDnsClient;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Illuminate\Contracts\Container\Container;

class HetznerDnsClientServiceProvider extends PackageServiceProvider
{
    public function packageRegistered()
    {
        $this->app->singleton(HetznerDnsClient::class);
        $this->app->alias(HetznerDnsClient::class, 'hetnzer-dns-client');
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-hetzner-dns-api')
            ->hasConfigFile('hetzner-dns');
    }
}
