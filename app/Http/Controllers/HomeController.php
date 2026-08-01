<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $services = Service::where('is_active', true)->get();
        $projects = \App\Models\Project::where('is_active', true)->latest()->get();
        
        return view('index', compact('settings', 'services', 'projects'));
    }
}
