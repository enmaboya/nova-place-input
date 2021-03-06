<?php

namespace Enmaboya\PlaceInput;

use Laravel\Nova\Fields\Field;
use Enmaboya\PlaceInput\Traits\CountryTrait;

class PlaceInput extends Field
{
    use CountryTrait;

    public $type = 'default';
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'place-input';

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        return $this->withMeta([
            'type' => $this->type == 'default'
                ? 'q'
                : $this->type
        ]);
    }

    public function onlyCities()
    {
        return $this->withMeta(['type' => 'city']);
    }

    public function onlyCountries()
    {
        return $this->withMeta(['type' => 'country']);
    }

    public function onlyStates()
    {
        return $this->withMeta(['type' => 'state']);
    }

    public function onlyCounties()
    {
        return $this->withMeta(['type' => 'county']);
    }

    public function byPostalCode()
    {
        return $this->withMeta(['type' => 'postalcode']);
    }

    public function countries(array $countries)
    {
        return $this->withMeta([
            'countrycodes' => $countries
        ]);
    }

    public function continents(array $continents)
    {
        return $this->withMeta([
            'countrycodes' => $this->getCountriesByContinent($continents)
        ]);
    }

    public function dependOnCountrySelect(string $field)
    {
        return $this->withMeta(['dependent_field' => $field]);
    }
}
