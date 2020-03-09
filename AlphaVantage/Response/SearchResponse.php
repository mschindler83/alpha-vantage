<?php
declare(strict_types=1);

namespace Mschindler83\AlphaVantage\Response;

use Mschindler83\AlphaVantage\ClientException;
use Mschindler83\AlphaVantage\Domain\Search\SearchResultItem;
use Mschindler83\AlphaVantage\Domain\Search\SearchResults;
use Mschindler83\ArrayAccess\ArrayAccess;
use Mschindler83\ArrayAccess\ArrayAccessValidationFailed;
use Psr\Http\Message\ResponseInterface;

class SearchResponse
{
    public static function fromPsrResponse(ResponseInterface $response): SearchResults
    {
        try {
            $access = ArrayAccess::createWithJsonSchemaValidation(
                \json_decode($response->getBody()->getContents(), true),
                \file_get_contents(__DIR__ . '/Schema/search-response.json')
            );

            return SearchResults::fromSearchResultItems(
                ...\array_map(
                    function (array $item): SearchResultItem {
                        return SearchResultItem::fromArrayAccess(ArrayAccess::create($item));
                    },
                    $access->array('bestMatches')
                )
            );
        } catch (ArrayAccessValidationFailed $e) {
            throw new ClientException(\sprintf('Schema validation failed: %s', \json_encode($e->errorMapping()->data())));
        }
    }
}