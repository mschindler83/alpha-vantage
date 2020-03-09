<?php
declare(strict_types=1);

namespace Mschindler83\AlphaVantage\Domain\Search;

use Mschindler83\ArrayAccess\ArrayAccess;

class SearchResultItem
{
    private string $symbol;
    private string $name;
    private string $type;
    private string $region;
    private string $marketOpen;
    private string $marketClose;
    private string $timezone;
    private string $currency;
    private string $matchScore;

    public static function fromArrayAccess(ArrayAccess $access): self
    {
        return new self(
            $access->string('1. symbol'),
            $access->string('2. name'),
            $access->string('3. type'),
            $access->string('4. region'),
            $access->string('5. marketOpen'),
            $access->string('6. marketClose'),
            $access->string('7. timezone'),
            $access->string('8. currency'),
            $access->string('9. matchScore'),
        );
    }

    private function __construct(
        string $symbol,
        string $name,
        string $type,
        string $region,
        string $marketOpen,
        string $marketClose,
        string $timezone,
        string $currency,
        string $matchScore
    ) {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->type = $type;
        $this->region = $region;
        $this->marketOpen = $marketOpen;
        $this->marketClose = $marketClose;
        $this->timezone = $timezone;
        $this->currency = $currency;
        $this->matchScore = $matchScore;
    }

    public function symbol(): string
    {
        return $this->symbol;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function region(): string
    {
        return $this->region;
    }

    public function marketOpen(): string
    {
        return $this->marketOpen;
    }

    public function marketClose(): string
    {
        return $this->marketClose;
    }

    public function timezone(): string
    {
        return $this->timezone;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function matchScore(): string
    {
        return $this->matchScore;
    }
}