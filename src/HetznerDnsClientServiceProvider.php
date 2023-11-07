<?php

namespace DutchCodingCompany\HetznerDnsClient;

use Illuminate\Contracts\Container\Container;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
