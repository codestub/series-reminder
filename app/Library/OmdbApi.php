<?php

namespace App\Library;

use App\Exceptions\CustomException;
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
        $client = new Client();

        $response = $client->request('GET', 'https://omdbapi.com', ['query' => [
            'apikey' => env('OMDB_API_KEY'),
            'i' => $this->imdbId,
            'type' => 'series'
        ]]);

        $data = (array) json_decode($response->getBody());

        $validator = Validator::make($data, [
            'Title' => 'required|string',
            'Type' => 'required|in:series',
            'Poster' => 'url',
            'totalSeasons' => 'required',
            'imdbID' => Rule::in([$this->imdbId])
        ]);

        if ($validator->fails()) {
            $series = Series::where('imdbId', $imdbId)->first();
    
            if ($series) {
                return response()->json(['error' => 'Series already added'], 409);
            }
    
            throw new CustomException('New series data failed validation', 500);
        }

        $series = Series::create([
            'imdbId' => $this->imdbId,
            'title' => $data['Title'],
            'image' => $data['Poster'],
            'total_seasons' => $data['totalSeasons']
        ]);

        if (!$series) {
            throw new CustomException('Something went wrong when saving new series', 500);
        }

        return true;
    }
}
