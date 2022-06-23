<?php

namespace DutchCodingCompany\HetznerDnsClient\Traits;

use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\AlwaysThrowsOnErrors;

trait ThrowsOnErrorsExceptNotFound
{
    /**
     * Always throw if there is something wrong with the request.
     *
     * @param SaloonRequest $request
     * @return void
     * @throws \Sammyjo20\Saloon\Exceptions\SaloonInvalidConnectorException
     */
    public function bootThrowsOnErrorsExceptNotFound(SaloonRequest $request): void
    {
        if ($this instanceof SaloonRequest && $this->traitExistsOnConnector(ThrowsOnErrorsExceptNotFound::class)) {
            return;
        }

        $this->addResponseInterceptor(function (SaloonRequest $request, SaloonResponse $response) {
            if($response->status() !== 404) {
                $response->throw();
            }

            return $response;
        });
    }
}
