<?php

namespace App\Http\Controllers;

use App\Series;
use Illuminate\Http\Request;
use App\Library\OmdbSeries;
use App\Library\OmdbSeason;
use App\Exceptions\CustomException;

class SeriesController extends Controller
{
    public function index()
    {
        return Series::all();
    }

    public function add()
    {
        $validatedRequest = request()->validate([
            'imdbId' => 'required|string'
        ]);

        $imdbId = $validatedRequest['imdbId'];

        try {
            $omdbSeries = new OmdbSeries($imdbId);
            $series = $omdbSeries->getSeries();

            for ($i = 1; $i <= $series->total_seasons; $i++) {
                $omdbSeason = new OmdbSeason($series->id, $i);
                $omdbSeason->getSeason();
            }
        } catch(CustomException $e) {
            return response()->json(['error' => 'faaaac'], 418);
            // return response()->json(['error' => 'test'], $e->code);
        }

        return response()->json(['message' => 'Successfully added!'], 200);
    }

    
}
