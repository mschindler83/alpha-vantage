<?php
declare(strict_types=1);

namespace Mschindler83\AlphaVantage\Request;

use GuzzleHttp\Psr7\Request;

class ForexExchangeRateRequest extends Request
{
    private string $fromCurrencyCode;
    private string $toCurrencyCode;

    public static function convert(string $fromCurrencyCode, string $toCurrencyCode): self
    {
        $instance = new self('GET', '/query');
        $instance->fromCurrencyCode = $fromCurrencyCode;
        $instance->toCurrencyCode = $toCurrencyCode;

        return $instance;
    }

    public function query(): array
    {
        return [
            'function' => 'CURRENCY_EXCHANGE_RATE',
            'from_currency' => $this->fromCurrencyCode,
            'to_currency' => $this->toCurrencyCode,
        ];
    }
}