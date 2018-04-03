<?php

namespace App\Library;

use App\Exceptions\CustomException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client;
use App\Series;
use Validator;

class OmdbApi
{
    public $imdbId;

    public function __construct($imdbId)
    {
        $this->imdbId = $imdbId;
    }
    
    public function addNewSeries()
    {
        if ($this->seriesExists()) {
            throw new CustomException('Series already added', 409);
        }

        $data = $this->fetchSeriesData();

        $this->validateSeriesData($data);

        $this->createSeries($data);

        return true;
    }

    protected function seriesExists()
    {
        $series = Series::where('imdbId', $this->imdbId)->first();
        
        if ($series) {
            return true;
        }

        return false;
    }

    protected function createSeries($data)
    {
        $series = Series::create([
            'imdbId' => $this->imdbId,
            'title' => $data['Title'],
            'image' => $data['Poster'],
            'total_seasons' => $data['totalSeasons']
        ]);

        if (!$series) {
            throw new CustomException('Something went wrong when saving the series', 500);
        }

        return true;
    }

    protected function fetchSeriesData()
    {
        try {
            $client = new Client();

            $response = $client->request('GET', 'https://omdbapi.com', ['query' => [
                'apikey' => env('OMDB_API_KEY'),
                'i' => $this->imdbId,
                'type' => 'series'
            ]]);

            $data = (array) json_decode($response->getBody());
        } catch(RequestException $e) {
            throw new CustomException($e->getMessage(), 500);
        } catch(ClientException $e) {
            throw new CustomException($e->getMessage(), 500);
        }

        return $data;
    }
    
    protected function validateSeriesData($data)
    {
        $validator = Validator::make($data, [
            'Title' => 'required|string',
            'Type' => 'required|in:series',
            'Poster' => 'url',
            'totalSeasons' => 'required',
            'imdbID' => Rule::in([$this->imdbId])
        ]);

        if ($validator->fails()) {
            throw new CustomException('New series data failed validation', 422);
        }

        return true;
    }
}
