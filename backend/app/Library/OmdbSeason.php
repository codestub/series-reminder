<?php

namespace App\Library;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use App\Library\Omdb;
use App\Season;
use App\Series;
use App\Episode;

class OmdbSeason extends Omdb
{
    public $series;
    public $season;

    public function __construct($seriesId, $season)
    {
        $this->season = $season;
        $this->series = Series::findOrFail($seriesId);
    }

    public function getSeason()
    {
        $data = $this->fetch([
            'i' => $this->series->imdb_id,
            'season' => $this->season
        ]);

        $this->persist($data);

        return true;
    }

    public function persist($data)
    {
        $season = Season::updateOrCreate(
            [
                'series_id' => $this->series->id,
                'number' => $this->season
            ]
        );

        for ($i = 1; $i <= count($data['Episodes']); $i++) {

            $episode = (array) $data['Episodes'][$i - 1];

            $this->validate($episode, [
                'Title' => 'string',
                'Released' => 'date'
            ]);

            Episode::updateOrCreate(
                [
                    'number' => $i,
                    'season_id' => $season->id,
                ],
                [
                    'number' => $i,
                    'season_id' => $season->id,
                    'release_date' => $episode['Released'],
                    'title' => $episode['Title']
                ]
            );
        }
    }
}