<?php

namespace App\Library;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use Validator;

class OmdbApi
{
    public function __construct()
    {
        //
    }

    public function fetch($query)
    {
        try {
            $client = new Client();

            $response = $client->request('GET', 'https://omdbapi.com', ['query' => array_merge(
                ['apikey' => env('OMDB_API_KEY')],
                $query
            )]);

            $data = (array) json_decode($response->getBody());
        } catch(RequestException $e) {
            throw new CustomException($e->getMessage(), 500);
        } catch(ClientException $e) {
            throw new CustomException($e->getMessage(), 500);
        }

        return $data;
    }

    public function validate($data, $validations)
    {
        $validator = Validator::make($data, $validations);

        if ($validator->fails()) {
            throw new CustomException('Failed validation', 422);
        }

        return true;
    }
}