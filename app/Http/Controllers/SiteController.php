<?php

namespace App\Http\Controllers;

use App\Enums\SiteTypeEnum;
use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use App\Models\Site;
use Inertia\Inertia;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sites = Site::all();

        return Inertia::render('Sites/Index', [
            'sites' => $sites,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = SiteTypeEnum::cases();

        return Inertia::render('Sites/Create', [
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiteRequest $request)
    {
        $siteData = $request->input('siteData');

        // Validate the site data array
        if ($request->input('type') == 'http') {
            $request->validate([
                'siteData.url' => 'required|url',
                'siteData.method' => 'required|string|in:GET,POST,PUT,PATCH,DELETE',
                'siteData.timing' => 'required|integer|min:15,max:1800',
            ]);
        }

        $site = new Site;
        $site->name = $request->input('name');
        $site->url = $request->input('url');
        $site->type = $request->input('type');
        $site->data = $siteData;
        $site->save();

        return redirect()->route('sites.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiteRequest $request, Site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        //
    }
}
