<?php
// config for DutchCodingCompany/HetznerDnsClient
return [
    'api_token' => env('HETZNER_DNS_API_TOKEN'),
    'default_ttl' => env('HETZNER_DNS_DEFAULT_TTL', 300),
];
