<?php
declare(strict_types=1);

namespace Mschindler83\AlphaVantage\Request;

use GuzzleHttp\Psr7\Request;

class SearchRequest extends Request
{
    private string $keywords;

    public static function queryString(string $searchQuery): self
    {
        $instance = new self('GET', '/query');
        $instance->keywords = $searchQuery;

        return $instance;
    }

    public function query(): array
    {
        return [
            'function' => 'SYMBOL_SEARCH',
            'keywords' => $this->keywords
        ];
    }
}