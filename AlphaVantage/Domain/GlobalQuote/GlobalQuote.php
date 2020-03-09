<?php
declare(strict_types=1);

namespace Mschindler83\AlphaVantage\Domain\GlobalQuote;

use Mschindler83\ArrayAccess\ArrayAccess;

class GlobalQuote
{
    private string $symbol;
    private float $open;
    private float $high;
    private float $low;
    private float $price;
    private int $volume;
    private \DateTimeImmutable $latestTradingDay;
    private float $previousClose;
    private float $change;
    private float $changePercent;

    public static function fromArrayAccess(ArrayAccess $access): self
    {
        return new self(
            $access->string('Global Quote', '01. symbol'),
            (float) $access->string('Global Quote', '02. open'),
            (float) $access->string('Global Quote', '03. high'),
            (float) $access->string('Global Quote', '04. low'),
            (float) $access->string('Global Quote', '05. price'),
            (int) $access->string('Global Quote', '06. volume'),
            $access->dateTimeImmutable('Y-m-d', 'Global Quote', '07. latest trading day'),
            (float) $access->string('Global Quote', '08. previous close'),
            (float) $access->string('Global Quote', '09. change'),
            (float) \str_replace('%', '', $access->string('Global Quote', '10. change percent')),
        );
    }

    private function __construct(
        string $symbol,
        float $open,
        float $high,
        float $low,
        float $price,
        int $volume,
        \DateTimeImmutable $latestTradingDay,
        float $previousClose,
        float $change,
        float $changePercent
    ) {
        $this->symbol = $symbol;
        $this->open = $open;
        $this->high = $high;
        $this->low = $low;
        $this->price = $price;
        $this->volume = $volume;
        $this->latestTradingDay = $latestTradingDay;
        $this->previousClose = $previousClose;
        $this->change = $change;
        $this->changePercent = $changePercent;
    }

    public function symbol(): string
    {
        return $this->symbol;
    }

    public function open(): float
    {
        return $this->open;
    }

    public function high(): float
    {
        return $this->high;
    }

    public function low(): float
    {
        return $this->low;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function volume(): int
    {
        return $this->volume;
    }

    public function latestTradingDay(): \DateTimeImmutable
    {
        return $this->latestTradingDay;
    }

    public function previousClose(): float
    {
        return $this->previousClose;
    }

    public function change(): float
    {
        return $this->change;
    }

    public function changePercent(): float
    {
        return $this->changePercent;
    }
}