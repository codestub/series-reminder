<?php

namespace App\Library;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client;
use App\Library\Omdb;
use App\Series;

class OmdbSeries extends Omdb
{
    public $imdbId;

    public function __construct($imdbId)
    {
        $this->imdbId = $imdbId;
    }

    public function getSeries()
    {   
        $data = $this->fetch([
            'i' => $this->imdbId
        ]);

        $this->validate($data, [
            'Title' => 'required|string',
            'Type' => 'required|in:series',
            'Poster' => 'url',
            'totalSeasons' => 'required',
            'imdbID' => Rule::in([$this->imdbId])
        ]);

        $series = $this->persist($data);

        return $series;
    }

    public function persist($data)
    {
        $series = Series::updateOrCreate(
            [
                'imdb_id' => $this->imdbId
            ],
            [
                'imdb_id' => $this->imdbId,
                'title' => $data['Title'],
                'image' => $data['Poster'],
                'total_seasons' => $data['totalSeasons']
            ]
        );

        return $series;
    }
}