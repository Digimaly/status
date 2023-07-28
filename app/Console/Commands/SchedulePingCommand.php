<?php

namespace App\Console\Commands;

use App\Jobs\RunHttpPing;
use App\Models\Site;
use Illuminate\Console\Command;

class SchedulePingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:ping
    {--timing= : The Timing of the ping (Default 15) } ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $timing = $this->option('timing') ?? 15;
        $this->info("Ping will be scheduled every {$timing} seconds");

        // We need to get all sites where the data['timing'] is equal to the timing
        $sites = Site::where('data->timing', $timing)->get();

        // We need to loop through all the sites and schedule the ping
        foreach ($sites as $site) {
            if ($site->type === 'http') {
                $this->info("Scheduling ping for {$site->name}");
                RunHttpPing::dispatch($site);
            }
        }
    }
}
