<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Traits\UploadsImages;

class ServiceController extends Controller
{
    use UploadsImages;

    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string'
        ]);

        Service::create($request->all());

        return response()->json(['success' => true, 'message' => 'Service added successfully!']);
    }

    public function edit(Service $service)
    {
        return response()->json($service);
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string'
        ]);

        $service->update($request->all());

        return response()->json(['success' => true, 'message' => 'Service updated successfully!']);
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(['success' => true, 'message' => 'Service deleted successfully!']);
    }
}
