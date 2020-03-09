<?php
declare(strict_types=1);

namespace Mschindler83\AlphaVantage\Response;

use Mschindler83\AlphaVantage\ClientException;
use Mschindler83\AlphaVantage\Domain\Forex\ExchangeRate;
use Mschindler83\ArrayAccess\ArrayAccess;
use Mschindler83\ArrayAccess\ArrayAccessValidationFailed;
use Psr\Http\Message\ResponseInterface;

class ForexExchangeRateResponse
{
    public static function fromPsrResponse(ResponseInterface $response): ExchangeRate
    {
        try {
            $access = ArrayAccess::createWithJsonSchemaValidation(
                \json_decode($response->getBody()->getContents(), true),
                \file_get_contents(__DIR__ . '/Schema/forex-exchange-rate-response.json')
            );

            return ExchangeRate::fromArrayAccess($access);
        } catch (ArrayAccessValidationFailed $e) {
            throw new ClientException(\sprintf('Schema validation failed: %s', \json_encode($e->errorMapping()->data())));
        }
    }
}