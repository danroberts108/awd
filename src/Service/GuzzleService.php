<?php

namespace App\Service;

use GuzzleHttp\Client;

class GuzzleService
{
    public function callApi(string $api) {
        $client = new Client([
            'base_uri' => $api,
            'timeout' => 2.0,
        ]);
    }
}