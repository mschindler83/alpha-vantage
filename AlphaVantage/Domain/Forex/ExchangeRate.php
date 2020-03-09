<?php
declare(strict_types=1);

namespace Mschindler83\AlphaVantage\Domain\Forex;

use Mschindler83\ArrayAccess\ArrayAccess;

class ExchangeRate
{
    private string $fromCurrencyCode;
    private string $fromCurrencyName;
    private string $toCurrencyCode;
    private string $toCurrencyName;
    private float $exchangeRate;
    private \DateTimeImmutable $lastRefreshed;
    private string $timezone;
    private float $bidPrice;
    private float $askPrice;

    public static function fromArrayAccess(ArrayAccess $access): self
    {
        $access = $access->arrayAccess('Realtime Currency Exchange Rate');
        return new self(
            $access->string('1. From_Currency Code'),
            $access->string('2. From_Currency Name'),
            $access->string('3. To_Currency Code'),
            $access->string('4. To_Currency Name'),
            (float) $access->string('5. Exchange Rate'),
            $access->dateTimeImmutable('Y-m-d H:i:s', '6. Last Refreshed'),
            $access->string('7. Time Zone'),
            (float) $access->string('8. Bid Price'),
            (float) $access->string('9. Ask Price'),
        );
    }

    public function fromCurrencyCode(): string
    {
        return $this->fromCurrencyCode;
    }

    public function fromCurrencyName(): string
    {
        return $this->fromCurrencyName;
    }

    public function toCurrencyCode(): string
    {
        return $this->toCurrencyCode;
    }

    public function toCurrencyName(): string
    {
        return $this->toCurrencyName;
    }

    public function exchangeRate(): float
    {
        return $this->exchangeRate;
    }

    public function lastRefreshed(): \DateTimeImmutable
    {
        return $this->lastRefreshed;
    }

    public function timezone(): string
    {
        return $this->timezone;
    }

    public function bidPrice(): float
    {
        return $this->bidPrice;
    }

    public function askPrice(): float
    {
        return $this->askPrice;
    }

    private function __construct(
        string $fromCurrencyCode,
        string $fromCurrencyName,
        string $toCurrencyCode,
        string $toCurrencyName,
        float $exchangeRate,
        \DateTimeImmutable $lastRefreshed,
        string $timezone,
        float $bidPrice,
        float $askPrice
    ) {
        $this->fromCurrencyCode = $fromCurrencyCode;
        $this->fromCurrencyName = $fromCurrencyName;
        $this->toCurrencyCode = $toCurrencyCode;
        $this->toCurrencyName = $toCurrencyName;
        $this->exchangeRate = $exchangeRate;
        $this->lastRefreshed = $lastRefreshed;
        $this->timezone = $timezone;
        $this->bidPrice = $bidPrice;
        $this->askPrice = $askPrice;
    }
}