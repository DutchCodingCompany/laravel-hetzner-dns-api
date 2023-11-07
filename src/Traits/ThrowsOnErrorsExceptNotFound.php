<?php

namespace DutchCodingCompany\HetznerDnsClient\Traits;

use Saloon\Contracts\PendingRequest;
use Saloon\Contracts\Response;

trait ThrowsOnErrorsExceptNotFound
{
    /**
     * Always throw if there is something wrong with the request, except if status code is 404.
     *
     * @param \Saloon\Contracts\PendingRequest $pendingRequest
     * @return void
     * @throws \Saloon\Exceptions\SaloonException
     */
    public static function bootThrowsOnErrorsExceptNotFound(PendingRequest $pendingRequest): void
    {
        $pendingRequest->middleware()->onResponse(function (Response $response) {
            if ($response->status() !== 404) {
                $response->throw();
            }

            return $response;
        });
    }
}
