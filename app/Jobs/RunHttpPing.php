<?php

namespace App\Jobs;

use App\Models\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class RunHttpPing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Site $site;

    /**
     * Create a new job instance.
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = $this->site->data;

        $method = $data['method'] ?? 'GET';

        $pingUrl = $data['url'];

        $method = strtolower($method);

        $response = Http::timeout(10)->{$method}($pingUrl);

        if ($response->successful()) {
            // We'll run stuff to bring it up, when it's time.
            $this->site->is_down = false;
        } else {
            // We'll run stuff to bring it down, when it's time.
            $this->site->is_down = true;
        }

        $this->site->save();
    }
}
