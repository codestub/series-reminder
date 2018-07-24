<?php

namespace App\Library;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client;
use App\Library\Omdb;
use App\Season;

class OmdbApiSeason extends Omdb
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
            'i' => $this->series->imdbId,
            'season' => $this->season
        ]);

        $this->validate($data, [
            'Season' => Rule::in([$this->season]),
            'Episodes.*.Title' => 'required|string',
            'Episodes.*.Episode' => 'required|integer|min:1',
            'Episodes.*.Released' => 'required|date'
        ]);

        $this->persist($data);

        return true;
    }

    public function persist($data)
    {
        Season::updateOrCreate(
            [
                'series_id' => $this->series->id,
                'number' => $this->season
            ]
        );

        foreach ($data->episodes as $episode) {
            Episode::updateOrCreate(
                [
                    'number' => $episode->Episode,
                    'season_id' => $this->season->id,
                ],
                [
                    'release_date' => $episode->Released
                ]
            );
        }
    }
}