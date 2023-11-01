<?php

namespace DutchCodingCompany\HetznerDnsClient\Enums;

enum RecordType: string
{
    case A = 'A';
    case AAAA = 'AAAA';
    case NS = 'NS';
    case MX = 'MX';
    case CNAME = 'CNAME';
    case RP = 'RP';
    case TXT = 'TXT';
    case SOA = 'SOA';
    case HINFO = 'HINFO';
    case SRV = 'SRV';
    case DANE = 'DANE';
    case TLSA = 'TLSA';
    case DS = 'DS';
    case CAA = 'CAA';
}
