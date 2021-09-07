
# Place Input for Laravel Nova

  

This package provides a customisable field with a city/country/place of interest search.

Powered by [Nominatim](https://nominatim.org/).

# Installation

```
composer require enmaboya/place-input
```

## Basic usage


```php
use Enmaboya\PlaceInput\PlaceInput;

PlaceInput::make('some_place')
```

### Available settings


1.  #### onlyCities - city search only

```php
use Enmaboya\PlaceInput\PlaceInput;

PlaceInput::make('some_place')->onlyCities()
```

3.  #### onlyCountries - country search only

```php
use Enmaboya\PlaceInput\PlaceInput;

PlaceInput::make('some_place')->onlyCountries()
```

5.  #### onlyStates - search only by state \ area

```php
use Enmaboya\PlaceInput\PlaceInput;

PlaceInput::make('some_place')->onlyStates()
```

7. #### onlyCounties - search by county only (e.g. Colombia county)

```php
use Enmaboya\PlaceInput\PlaceInput;

PlaceInput::make('some_place')->onlyCounties()
```

8.  #### byPostalCode - search by zip code \ postal code

```php
use Enmaboya\PlaceInput\PlaceInput;

PlaceInput::make('some_place')->byPostalCode()
```

9.  #### continents - limit the search to selected continents

```php
use Enmaboya\PlaceInput\PlaceInput;

PlaceInput::make('some_place')->continents(['NA', 'SA'])
```
Available list of continents:

 - AF - Africa
 - AS - Asia
 - EU - Europe
 - NA - North America
 - OC - Oceania
 - SA - South America

10.  #### countries - limit the search to selected countries

```php
use Enmaboya\PlaceInput\PlaceInput;

PlaceInput::make('some_place')->countries(['RU', 'US', 'CN', 'JP'])
```

11.  #### dependOnCountrySelect - If you use the [County Select field](https://github.com/enmaboya/nova-country-select), the search will be restricted to the country selected in County Select.

```php
use Enmaboya\CountrySelect\CountrySelect;
use Enmaboya\PlaceInput\PlaceInput;

CountrySelect::make('Country', 'county_code');

PlaceInput::make('some_place')->dependOnCountrySelect('county_code'),
```

  
## License

  

The MIT License (MIT). Please see [License File](https://github.com/enmaboya/nova-place-input/blob/main/LICENSE) for more information.
