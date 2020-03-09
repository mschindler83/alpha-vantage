<?php
declare(strict_types=1);

namespace Mschindler83\AlphaVantage;

use Assert\Assertion;
use Assert\AssertionFailedException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Mschindler83\AlphaVantage\Domain\Forex\ExchangeRate;
use Mschindler83\AlphaVantage\Domain\GlobalQuote\GlobalQuote;
use Mschindler83\AlphaVantage\Domain\Search\SearchResults;
use Mschindler83\AlphaVantage\Request\ForexExchangeRateRequest;
use Mschindler83\AlphaVantage\Request\GlobalQuoteRequest;
use Mschindler83\AlphaVantage\Request\SearchRequest;
use Mschindler83\AlphaVantage\Response\ForexExchangeRateResponse;
use Mschindler83\AlphaVantage\Response\GlobalQuoteResponse;
use Mschindler83\AlphaVantage\Response\SearchResponse;
use Psr\Http\Message\ResponseInterface;

final class Client
{
    private static $instance;

    private ClientInterface $client;
    private string $apiKey;

    public static function instance(string $apiKey = null): self
    {
        if (!self::$instance) {
            self::$instance = new self($apiKey);
        }

        return self::$instance;
    }

    public function search(SearchRequest $request): SearchResults
    {
        $response = $this->sendRequest($request);

        return SearchResponse::fromPsrResponse($response);
    }

    public function globalQuote(GlobalQuoteRequest $request): GlobalQuote
    {
        $response = $this->sendRequest($request);

        return GlobalQuoteResponse::fromPsrResponse($response);
    }

    public function forexExchangeRate(ForexExchangeRateRequest $request): ExchangeRate
    {
        $response = $this->sendRequest($request);

        return ForexExchangeRateResponse::fromPsrResponse($response);
    }

    private function sendRequest(Request $request): ResponseInterface
    {
        try {
            $query = $request->query();
            $query['apikey'] = $this->apiKey;

            return $this->client->send($request, ['query' => $query]);
        } catch (GuzzleException $e) {
            throw new ClientException(\sprintf('%s: %s', \get_class($request), $e->getMessage()), 0, $e);
        }
    }

    private function __construct(string $apiKey)
    {
        try {
            Assertion::minLength($apiKey, 1, 'Invalid Alpha Vantage api key');
            $this->client = new GuzzleClient(
                [
                    'base_uri' => 'https://www.alphavantage.co'
                ]
            );
            $this->apiKey = $apiKey;
        } catch (AssertionFailedException $e) {
            throw new ClientException(
                \sprintf('Alpha Vantage client exception: %s', $e->getMessage()),
                0,
                $e
            );
        }
    }

    private function __clone() {}
}