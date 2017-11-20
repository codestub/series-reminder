<?php

namespace App\Http\Controllers;

use App\Series;
use Illuminate\Http\Request;
use App\Library\OmdbApi;

class SeriesController extends Controller
{
    public function index()
    {
        // Return all series with pagination
    }

    public function add()
    {
        $validatedRequest = request()->validate([
            'imdbId' => 'required|string'
        ]);

        $imdbId = $validatedRequest['imdbId'];
        
        $series = Series::where('imdbId', $imdbId)->first();

        if ($series) {
            return response()->json(['error' => 'Series already added'], 409);
        }

        $omdb = new OmdbApi($imdbId);

        if (!$omdb->addNewSeries()) {
            response()->json(['error' => 'Something went wrong'], 500);
        }

        return response()->json(['message' => 'Successfully added to database!'], 200);
    }
}
