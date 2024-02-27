<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OmdbService
{

    public function __construct (private HttpClientInterface $client) {

    }

    public function search(string $term) {

        $response = $this->client->request(
            'GET',
            'http://omdbapi.com/?apikey='.$_ENV['omdbapikey'].'&t='.$term
        );

        if ($response->getStatusCode() != 200 || $response->getHeaders()['content-type'][0] != 'application/json') {
            return null;
        }

        return $response->getContent();
    }

}