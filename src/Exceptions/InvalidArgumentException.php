<?php

namespace DutchCodingCompany\HetznerDnsClient\Exceptions;

use InvalidArgumentException as BaseInvalidArgumentException;

class InvalidArgumentException extends BaseInvalidArgumentException implements HetznerDnsApiException
{
    //
}
