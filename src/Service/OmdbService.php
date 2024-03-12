<?php

namespace App\Service;

use GuzzleHttp\Client;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OmdbService
{
    private string $apiKey = '2772186';

    public function searchByTitle(string $term, ?int $year = null) {
        $client = new Client([
            'base_uri' => 'http://omdbapi.com/'
        ]);

        $safeterm = str_replace(' ', '+', $term);

        if ($year != null) {
            $response = $client->request('GET', '?apikey='.$this->apiKey.'&t='.$safeterm.'&y='.$year);
        } else {
            $response = $client->request('GET', '?apikey='.$this->apiKey.'&t='.$safeterm);
        }

        if ($response->getStatusCode() == 200 && $response->hasHeader('Content-Length')) {
            return $response->getBody()->getContents();
        } else {
            return null;
        }

    }

    public function searchByTerm(string $term) {
        $client = new Client([
            'base_uri' => 'http://omdbapi.com/'
        ]);

        $safeterm = str_replace(' ', '+', $term);

        $response = $client->request('GET', '?apikey='.$this->apiKey.'&s='.$safeterm);

        if($response->getStatusCode() == 200 && $response->hasHeader('Content-Length')) {
            return $response->getBody()->getContents();
        } else {
            return null;
        }
    }

    public function findById(string $id) : ?string {
        $client = new Client([
            'base_uri' => 'http://omdbapi.com/'
        ]);

        $response = $client->request('GET', '?apikey='.$this->apiKey.'&i='.$id);

        if ($response->getStatusCode() == 200 && $response->hasHeader('Content-Length')) {
            return $response->getBody()->getContents();
        } else {
            return null;
        }
    }

    public function getImgUri(string $id) {
        $imgclient = new Client([
            'base_uri' => 'http://img.omdbapi.com/'
        ]);

        $response = $imgclient->request('GET', 'i='.$id);

        if ($response->getStatusCode() == 200 && $response->hasHeader('Content-Length')) {
            return $response->getBody();
        } else {
            return null;
        }
    }

}