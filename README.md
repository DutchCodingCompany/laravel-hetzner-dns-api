
# An unofficial PHP SDK for the Hetzner DNS API.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dutchcodingcompany/laravel-hetzner-dns-api.svg?style=flat-square)](https://packagist.org/packages/dutchcodingcompany/laravel-hetzner-dns-api)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/dutchcodingcompany/laravel-hetzner-dns-api/run-tests?label=tests)](https://github.com/dutchcodingcompany/laravel-hetzner-dns-api/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/dutchcodingcompany/laravel-hetzner-dns-api/Check%20&%20fix%20styling?label=code%20style)](https://github.com/dutchcodingcompany/laravel-hetzner-dns-api/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/dutchcodingcompany/laravel-hetzner-dns-api.svg?style=flat-square)](https://packagist.org/packages/dutchcodingcompany/laravel-hetzner-dns-api)

This PHP/Laravel client around the [Hetzner DNS API](https://dns.hetzner.com/api-docs) support:
- Zones
- Records

This SDK is based on [Saloon](https://docs.saloon.dev/), a Laravel / PHP package that helps write API integrations and SDKs.


## Installation

You can install the package via composer:

```bash
composer require dutchcodingcompany/laravel-hetzner-dns-api
```

Set your hetzner dns api token in your .env file:
```env
HETZNER_DNS_API_TOKEN=hetzner-dns-token-here
```

## Configuration (optional)
You can publish the config file with:

```bash
php artisan vendor:publish --tag="hetzner-dns-api-config"
```

This is the contents of the published config file [can be found here](config/hetzner-dns.php).

If you would like to store the API Token outside of the config (e.g. encrypted in the database), you can override the resolver in the `boot` method of the `AppServiceProvider`
```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DutchCodingCompany\HetznerDnsClient\HetznerDnsClient;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        HetznerDnsClient::resolveApiTokenUsing(fn () => 'your-token');
    }
}
```

## Usage

```php
$records = HetznerDnsClient::records()->all();
// resolves to a Records DTO
```

## ToDo
- Caching
- ...

[//]: # (## Testing)

[//]: # ()
[//]: # (```bash)

[//]: # (composer test)

[//]: # (```)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Niek Brekelmans](https://github.com/niekbr)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
