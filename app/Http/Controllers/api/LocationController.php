<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    // ✅ Get all locations
    public function index()
    {
        $locations = Location::all();

        return response()->json([
            'status' => true,
            'data' => $locations
        ]);
    }

    // ✅ Store new location
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $location = Location::create([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Location created successfully',
            'data' => $location
        ]);
    }

    // ✅ Show single location
    public function show($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'status' => false,
                'message' => 'Location not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $location
        ]);
    }

    // ✅ Update location
    public function update(Request $request, $id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'status' => false,
                'message' => 'Location not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $location->update([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Location updated successfully',
            'data' => $location
        ]);
    }

    // ✅ Delete location
    public function destroy($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'status' => false,
                'message' => 'Location not found'
            ], 404);
        }

        $location->delete();

        return response()->json([
            'status' => true,
            'message' => 'Location deleted successfully'
        ]);
    }
}