<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with statistics.
     */
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'services' => Service::count(),
            'active_projects' => Project::where('is_active', true)->count(),
            'active_services' => Service::where('is_active', true)->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
