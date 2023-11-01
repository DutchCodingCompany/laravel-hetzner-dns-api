<?php

namespace DutchCodingCompany\HetznerDnsClient\Traits;

use Saloon\Http\Request;
use Saloon\Http\Response;

trait ThrowsOnErrorsExceptNotFound
{
    /**
     * Always throw if there is something wrong with the request.
     *
     * @param Request $request
     * @return void
     * @throws \Saloon\Exceptions\SaloonInvalidConnectorException
     */
    public function bootThrowsOnErrorsExceptNotFound(Request $request): void
    {
        if ($this instanceof Request && $this->traitExistsOnConnector(ThrowsOnErrorsExceptNotFound::class)) {
            return;
        }

        $this->addResponseInterceptor(function (Request $request, Response $response) {
            if($response->status() !== 404) {
                $response->throw();
            }

            return $response;
        });
    }
}
