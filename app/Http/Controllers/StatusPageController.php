<?php

namespace App\Http\Controllers;

use App\Models\Downtime;
use App\Models\Site;
use Inertia\Inertia;

class StatusPageController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome', [
            'sites' => fn () => Site::all()->transform(function ($site) {
                return [
                    'id' => $site->id,
                    'name' => $site->name,
                    'url' => $site->url,
                    'is_down' => $site->is_down,
                    'updated_at' => $site->updated_at->shortRelativeToNowDiffForHumans(),
                ];

            }),
            'downtimes' => fn () => Downtime::latest()->get()->map(function ($downtime) {
                return [
                    'id' => $downtime->id,
                    'site_id' => $downtime->site_id,
                    'site_name' => $downtime->site->name,
                    'created_at' => $downtime->created_at->shortRelativeToNowDiffForHumans(),
                    'updated_at' => $downtime->updated_at->shortRelativeToNowDiffForHumans(),
                    // Create the duration between the created_at and updated_at timestamps
                    'duration' => $downtime->created_at->longAbsoluteDiffForHumans($downtime->updated_at),

                ];
            }),
        ]);
    }
}
