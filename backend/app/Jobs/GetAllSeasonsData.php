<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetAllSeasonsData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imdbId;

    public function __construct($imdbId)
    {
        $this->imdbId = $imdbId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Dispatch other jobs
    }
}
