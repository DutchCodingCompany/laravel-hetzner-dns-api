# Changelog

All notable changes to `laravel-hetzner-dns-api` will be documented in this file.

## 1.0.0 - 2023-11-07

### Changes
- renamed `\DutchCodingCompany\HetznerDnsClient\RequestCollections\RecordCollection` to `\DutchCodingCompany\HetznerDnsClient\Resources\RecordResource`
- renamed `\DutchCodingCompany\HetznerDnsClient\RequestCollections\ZoneCollection` to `\DutchCodingCompany\HetznerDnsClient\Resources\ZoneResource`
- removed `bensampo/laravel-enum` package, `\DutchCodingCompany\HetznerDnsClient\Enums\RecordType` is now a native enum
- dropped support for laravel 8.0
- added support for laravel 10.0
- removed `spatie/data-transfer-object`

## 0.1.0 - 2022-06-23

Initial release
