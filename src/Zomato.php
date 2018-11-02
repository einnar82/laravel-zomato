<?php

namespace RannieOllit\Zomato;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;

class Zomato
{
    const API_URL = 'https://developers.zomato.com/api/v2.1';

    protected $createRequest, $apiKey;

    public function __construct($apiKey) {
        $this->createRequest = new Client(['headers' => ['user-key' => $apiKey], 'http_errors' => false]);
    }
    /**
     * Get a list of categories. List of all restaurants categorized under a particular restaurant type can be obtained using
     * /Search API with Category ID as inputs
     */
    public function getCategories(): Stream
    {
       return $this->makeRequest('GET','categories');
    }

    /**
     * Find the Zomato ID and other details for a city . You can obtain the Zomato City ID in one of the following ways:
     * City Name in the Search Query - Returns list of cities matching the query
     * Using coordinates - Identifies the city details based on the coordinates of any location inside a city
     * If you already know the Zomato City ID, this API can be used to get other details of the city.
     */
    public function getCityDetails(array $params): Stream
    {
        return $this->makeRequest('GET','cities', $params);
    }

    /**
     * Returns Zomato Restaurant Collections in a City. The location/City input can be provided in the following ways
     * - Using Zomato City ID
     * - Using coordinates of any location within a city
     * List of all restaurants listed in any particular Zomato Collection can be obtained using the '/search' API with Collection ID and Zomato City ID as the input
     */
    public function getCityCollections(array $params): Stream
    {
        return $this->makeRequest('GET','collections', $params);
    }

    /**
     * Get a list of all cuisines of restaurants listed in a city. The location/city input can be provided in the following ways
     *  - Using Zomato City ID
     *  - Using coordinates of any location within a city
     * List of all restaurants serving a particular cuisine can be obtained using '/search' API with cuisine ID and location details
     */
    public function getCityCuisines(array $params): Stream
    {
        return $this->makeRequest('GET','cuisines', $params);
    }


    /**
     * Get a list of restaurant types in a city. The location/City input can be provided in the following ways
     * - Using Zomato City ID
     * - Using coordinates of any location within a city
     * List of all restaurants categorized under a particular restaurant type can obtained using /Search API with Establishment ID and location details as inputs
     */
    public function getCityRestaurantTypes(array $params): Stream
    {
        return $this->makeRequest('GET','establishments', $params);
    }

    /**
     * Get Foodie and Nightlife Index, list of popular cuisines and nearby restaurants around the given coordinates
     */
    public function getRestaurantCoordinates(array $params): Stream
    {
        return $this->makeRequest('GET','geocode', $params);
    }

    /**
     * Get Foodie Index, Nightlife Index, Top Cuisines and Best rated restaurants in a given location
     */
    public function getLocationDetails(array $params): Stream
    {
        return $this->makeRequest('GET','location_details', $params);
    }

    /**
     * Search for Zomato locations by keyword. Provide coordinates to get better search results
     */
    public function searchLocations(array $params): Stream
    {
        return $this->makeRequest('GET','locations', $params);
    }

    /**
     * Get daily menu using Zomato restaurant ID.
     */
    public function getDailyMenu(array $params): Stream
    {
        return $this->makeRequest('GET','dailymenu', $params);
    }

    /**
     * Get detailed restaurant information using Zomato restaurant ID. Partner Access is required to access photos and reviews.
     */
    public function getRestaurantDetails(array $params): Stream
    {
        return $this->makeRequest('GET','restaurant', $params);
    }

    /**
     * Get restaurant reviews using the Zomato restaurant ID. Only 5 latest reviews are available under the Basic API plan.
     */
    public function getRestaurantReviews(array $params)
    {
        return $this->makeRequest('GET','reviews', $params);
    }

    /**
     * The location input can be specified using Zomato location ID or coordinates. Cuisine / Establishment / Collection IDs can be obtained from respective api calls. Get up to 100 restaurants by changing the 'start' and 'count' parameters with the maximum value of count being 20. Partner Access is required to access photos and reviews.
     * Examples:
     * - To search for 'Italian' restaurants in 'Manhattan, New York City', set cuisines = 55, entity_id = 94741 and entity_type = zone
     * - To search for 'cafes' in 'Manhattan, New York City', set establishment_type = 1, entity_type = zone and entity_id = 94741
     * - Get list of all restaurants in 'Trending this Week' collection in 'New York City' by using entity_id = 280, entity_type = city and collection_id = 1
     */
    public function searchForRestaurants(array $params)
    {
        return $this->makeRequest('GET','search', $params);
    }
    /**
     * Add query parameters
     */
    private function parameters(array $params)
    {
        return [
            'query' => $params
        ];
    }

    /**
     * Make a request from api
     */

     private function makeRequest(string $type, string $endpoint, array $queries = []): Stream
     {
        $request = $this->createRequest->request($type, self::API_URL.'/'.$endpoint, $this->parameters($queries));
        return $request->getBody();
     }
}
