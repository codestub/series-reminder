<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetSeasonData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imdbId;

    public function __construct($imdbId, $season)
    {
        $this->imdbId = $imdbId;
        $this->season = $season;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client();

        $response = $client->request('GET', 'https://omdbapi.com/', [
            'query' => [
                'i' => $this->imdbId,
                'apikey' => 'PlzBanMe'
            ]
        ]);

        dd($response);
    }

    public function validate()
    {
        //
    }
}
