<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    // ✅ Get all departments
    public function index()
    {
        $departments = Department::with('location')->get();

        return response()->json([
            'status' => true,
            'data' => $departments
        ]);
    }

    // ✅ Store new department
    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $department = Department::create([
            'location_id' => $request->location_id,
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Department created successfully',
            'data' => $department
        ]);
    }

    // ✅ Show single department
    public function show($id)
    {
        $department = Department::with(['location', 'reasons', 'audits'])->find($id);

        if (!$department) {
            return response()->json([
                'status' => false,
                'message' => 'Department not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $department
        ]);
    }

    // ✅ Update department
    public function update(Request $request, $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json([
                'status' => false,
                'message' => 'Department not found'
            ], 404);
        }

        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $department->update([
            'location_id' => $request->location_id,
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Department updated successfully',
            'data' => $department
        ]);
    }

    // ✅ Delete department
    public function destroy($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json([
                'status' => false,
                'message' => 'Department not found'
            ], 404);
        }

        $department->delete();

        return response()->json([
            'status' => true,
            'message' => 'Department deleted successfully'
        ]);
    }

    public function byLocation($locationId)
    {
        $departments = Department::where('location_id', $locationId)->get();

        return response()->json([
            'status' => true,
            'data' => $departments
        ]);
    }
}