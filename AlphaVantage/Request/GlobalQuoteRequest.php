<?php
declare(strict_types=1);

namespace Mschindler83\AlphaVantage\Request;

use GuzzleHttp\Psr7\Request;

class GlobalQuoteRequest extends Request
{
    private string $symbol;

    public static function symbol(string $symbol): self
    {
        $instance = new self('GET', '/query');
        $instance->symbol = $symbol;

        return $instance;
    }

    public function query(): array
    {
        return [
            'function' => 'GLOBAL_QUOTE',
            'symbol' => $this->symbol
        ];
    }
}