<?php
// config for DutchCodingCompany/HetznerDnsClient
return [
    'api_token' => env('HETZNER_DNS_API_TOKEN'),
    'default_ttl' => env('HETZNER_DNS_DEFAULT_TTL', 300),
    'nameservers' => [
        env('HETZNER_NAMESERVER_1', 'hydrogen.ns.hetzner.com.'),
        env('HETZNER_NAMESERVER_2', 'oxygen.ns.hetzner.com.'),
        env('HETZNER_NAMESERVER_3', 'helium.ns.hetzner.de.'),
    ]
];
