<?php

namespace App\Jobs;

use App\Models\Downtime;
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

        try {
            $response = Http::timeout(10)->{$method}($pingUrl);
        } catch (\Exception $e) {
            $this->site->is_down = true;
            $this->markSiteAsDown();
            $this->site->save();

            return;
        }

        if ($response->successful()) {
            // We'll run stuff to bring it up, when it's time.
            $this->site->is_down = false;
            $this->markSiteAsUp();
        } else {
            // We'll run stuff to bring it down, when it's time.
            $this->site->is_down = true;
            $this->markSiteAsDown();
        }

        $this->site->updated_at = now();

        $this->site->save();
    }

    private function markSiteAsUp()
    {
        $downtime = Downtime::where('site_id', $this->site->id)->whereNull('end_time')->first();

        if ($downtime) {
            $downtime->end_time = now();
            $downtime->duration = $downtime->start_time->diffInSeconds($downtime->end_time);
            $downtime->save();
        }
    }

    private function markSiteAsDown()
    {
        $downtime = Downtime::where('site_id', $this->site->id)->whereNull('end_time')->first();

        if (! $downtime) {
            $downtime = new Downtime();
            $downtime->site_id = $this->site->id;
            $downtime->start_time = now();
            $downtime->save();
        }
    }
}
