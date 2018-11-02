# laravel-zomato

An API Wrapper for [Zomato](https://zomato.com/). 

# Prerequisites

* Register an account to get an API Key

### Installation

Type in your terminal 

```sh
$ composer require einnar82/laravel-zomato
```

Add the service provider in your config => app.php

```php
RannieOllit\Zomato\ZomatoServiceProvider::class,
```

and the Facade

```php
'Zomato' => RannieOllit\Zomato\Facades\Zomato::class
```

Publish the zomato.php file via

```ssh
$ php artisan vendor:publish 
```

and select 

```ssh
 RannieOllit\Zomato\ZomatoServiceProvider
```

Then, you can use the Zomato Facade;

# List of methods in laravel-zomato


| method        | information   | 
| ------------- |:-------------:|
| getCategories    | Get list of Categories |
| getCityDetails(array $params)    | Get city details      |
| getCityCollections(array $params) | Get Zomato collections in a city      |
| getCityCuisines(array $params) | Get list of all cuisines in a city     |
| getCityRestaurantTypes(array $params) |  Get list of restaurant types in a city     |
| getRestaurantCoordinates(array $params) | Get location details based on coordinates    |
| getLocationDetails(array $params) |  Get Zomato location details    |
| searchLocations(array $params) | Search for locations   |
| getDailyMenu(array $params) |  Get daily menu of a restaurant   |
| getRestaurantDetails(array $params) | Get restaurant details   |
| getRestaurantReviews(array $params) | Get restaurant reviews  |
| searchForRestaurants(array $params) |  Search for restaurants |


You may check the Zomato [documentation](https://developers.zomato.com/documentation) for details. 