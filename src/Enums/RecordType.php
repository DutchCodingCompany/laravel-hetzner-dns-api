<?php

namespace DutchCodingCompany\HetznerDnsClient\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static A()
 * @method static static AAAA()
 * @method static static NS()
 * @method static static MX()
 * @method static static CNAME()
 * @method static static RP()
 * @method static static TXT()
 * @method static static SOA()
 * @method static static HINFO()
 * @method static static SRV()
 * @method static static DANE()
 * @method static static TLSA()
 * @method static static DS()
 * @method static static CAA()
 */
final class RecordType extends Enum
{
    public const A = 'A';
    public const AAAA = 'AAAA';
    public const NS = 'NS';
    public const MX = 'MX';
    public const CNAME = 'CNAME';
    public const RP = 'RP';
    public const TXT = 'TXT';
    public const SOA = 'SOA';
    public const HINFO = 'HINFO';
    public const SRV = 'SRV';
    public const DANE = 'DANE';
    public const TLSA = 'TLSA';
    public const DS = 'DS';
    public const CAA = 'CAA';
}
