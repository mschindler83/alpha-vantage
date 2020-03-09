<?php
declare(strict_types=1);

namespace Mschindler83\AlphaVantage\Domain\Search;

class SearchResults
{
    /**
     * @var SearchResultItem[]
     */
    private array $items;

    public static function fromSearchResultItems(SearchResultItem ...$items): self
    {
        return new self($items);
    }

    /**
     * @return SearchResultItem[]
     */
    public function resultItems(): array
    {
        return $this->items;
    }

    private function __construct(array $items)
    {
        $this->items = $items;
    }
}