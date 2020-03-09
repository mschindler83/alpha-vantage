# Array Access
[![Build Status](https://img.shields.io/travis/mschindler83/alpha-vantage/master.svg)](https://travis-ci.org/mschindler83/array-access)
[![Latest Stable Version](https://img.shields.io/packagist/v/mschindler83/alpha-vantage.svg)](https://packagist.org/packages/mschindler83/array-access)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/mschindler83/alpha-vantage.svg)](https://scrutinizer-ci.com/g/mschindler83/array-access/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/mschindler83/alpha-vantage/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mschindler83/array-access/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/mschindler83/alpha-vantage/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Monthly Downloads](https://img.shields.io/packagist/dm/mschindler83/alpha-vantage.svg)](https://packagist.org/packages/mschindler83/array-access)


Wrapper library for the Alpha Vantage API
Requires PHP >= 7.4

## Install
`composer require mschindler83/alpha-vantage`

## Features
- Get forex exchange rates
- Search for symbol
- Get global quote
- [...] More to come soon

## Usage Examples

### Get a client instance
```
$alphaVantage = \Mschindler83\AlphaVantage\Client::instance($apiKey)
```

### Get forex exchange rate
```
$request = ForexExchangeRateRequest::convert('EUR', 'USD');
$exchangeRate = $alphaVantage->forexExchangeRate($request);

echo $exchangeRate->exchangeRate();
```

### Search for symbol
```
$request = SearchRequest::queryString('MSCI World');
$searchResults = $alphaVantage->search($request);

$allResultsArray = $searchResults->items();
echo $allResultsArray[0]->symbol();
```

### Get global quote
```
$request = GlobalQuoteRequest::symbol('IWDA.LON');
$globalQuote = $alphaVantage->globalQuote($request);

echo $globalQuote->open();
echo $globalQuote->high();
echo $globalQuote->low();
[...]
```
