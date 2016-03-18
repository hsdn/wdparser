## HSDN Weather-Display Parser Class

This script is a PHP library for parsing all data files of Weather-Display software, and convert it to an array of parameters. The parser also supports data validation, it allows to test the data of you station, check that the station is on-line.

To parse the METAR information, which also provides the Weather-Display, the library requires a our **METAR/TAF Parser**: https://github.com/hsdn/metar-taf

- Weather-Display software home: http://www.weather-display.com

The parser supports the following data files:
- wdfulldata.xml
- clientraw.txt
- clientrawextra.txt
- clientrawhour.txt
- clientrawdaily.txt

### Usage example:
```php
require_once 'src/WeatherDisplay.php';

// Station URL
$url = 'http://st1.meteo.hsdn.org';

// Get all station files
$wdfulldata     = file_get_contents($url.'/wdfulldata.xml');
$clientraw      = file_get_contents($url.'/clientraw.txt');
$clientrawextra = file_get_contents($url.'/clientrawextra.txt');
$clientrawhour  = file_get_contents($url.'/clientrawhour.txt');
$clientrawdaily = file_get_contents($url.'/clientrawdaily.txt');

// Create class instance
$wd = new WeatherDisplay;

// Set station locale set (language) for date parsing
$wd->locale = 'ru_RU';

// Parse "wdfulldata.xml" file
$wdfulldata_array = $wd->parse_wdfulldata($wdfulldata);

print_r($wdfulldata_array); // print array of the data

// Parse "clientraw.txt" file
$clientraw_array = $wd->parse_clientraw($clientraw);

print_r($clientraw_array); // print array of the data

// Parse "clientrawextra.txt" file
$clientrawextra_array = $wd->parse_clientraw($clientrawextra);

print_r($clientrawextra_array); // print array of the data

// Parse "clientrawhour.txt" file
$clientrawhour_array = $wd->parse_clientraw($clientrawhour);

print_r($clientrawhour_array); // print array of the data

// Parse "clientrawdaily.txt" file
$clientrawdaily_array = $wd->parse_clientrawdaily($clientrawdaily);

print_r($clientrawdaily_array); // print array of the data
```

##### Data validation:
```php
// Check the age of the data in file "wdfulldata.xml" (no more than 600 seconds)
$bool = $wd->validate_wdfulldata_date($wdfulldata_array, 600);

// Check the age of the data in file "clientraw.txt" (no more than 600 seconds)
$bool = $wd->validate_clientraw_date($clientraw_array, 600);

// Check the last hour data fields in "clientrawhour.txt" and the live data from "clientraw.txt".
// This check detects hanging station. If hung, all data for the last hour - will have identical.
$bool = $wd->validate_clientrawhour_fields($clientraw_array, $clientrawhour_array);
```

### Demonstration
- http://www.hsdn.info/wdparser/

### License
    HSDN Weather-Display Parser

    Copyright (C) 2015, Information Networks, Ltd.

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program. If not, see <http://www.gnu.org/licenses/>.
