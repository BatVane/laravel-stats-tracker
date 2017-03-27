<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tracker;
class TrackerController extends Controller
{
    public function show(){

        $pageViews = Tracker::pageViews(60 * 24 * 120);

        $pageViewsPerCountry = Tracker::pageViewsByCountry(60 * 24 * 120);

        $allData = [$pageViews,$pageViewsPerCountry];

        return view('index', compact('crumbs','allData','selected_period'));
    }
}
