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
            'sites' => fn () => Site::all(),
            'downtimes' => fn () => Downtime::all(),
        ]);
    }
}
