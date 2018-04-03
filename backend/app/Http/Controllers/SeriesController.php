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

        try {
            $omdb = new OmdbApi($imdbId);
            $omdb->addNewSeries();
        } catch(CustomException $e) {
            return response()->json(['error' => 'faaaac'], 418);
            // return response()->json(['error' => 'test'], $e->code);
        }

        return response()->json(['message' => 'Successfully added!'], 200);
    }
}
