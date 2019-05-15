# Country Factory
Creates instances of Country from ISO 2 Country Code

## Usage
```php
$country = EricksonReyes\DomainDrivenDesign\Common\Factory\CountryFactory::create('US');

echo $country->iso2Code(); # Returns "US"
echo $country->iso3Code(); # Returns "USA"
echo $country->name(); # Returns "United States"
```