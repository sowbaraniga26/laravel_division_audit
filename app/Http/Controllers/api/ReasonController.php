<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reason;

class ReasonController extends Controller
{
    // ✅ Get all reasons
    public function index()
    {
        $reasons = Reason::with('department')->get();

        return response()->json([
            'status' => true,
            'data' => $reasons
        ]);
    }

    // ✅ Store new reason
    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'reason' => 'required|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $reason = Reason::create([
            'department_id' => $request->department_id,
            'reason' => $request->reason,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Reason created successfully',
            'data' => $reason
        ]);
    }

    // ✅ Show single reason
    public function show($id)
    {
        $reason = Reason::with(['department', 'audits'])->find($id);

        if (!$reason) {
            return response()->json([
                'status' => false,
                'message' => 'Reason not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $reason
        ]);
    }

    // ✅ Update reason
    public function update(Request $request, $id)
    {
        $reason = Reason::find($id);

        if (!$reason) {
            return response()->json([
                'status' => false,
                'message' => 'Reason not found'
            ], 404);
        }

        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'reason' => 'required|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $reason->update([
            'department_id' => $request->department_id,
            'reason' => $request->reason,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Reason updated successfully',
            'data' => $reason
        ]);
    }

    // ✅ Delete reason
    public function destroy($id)
    {
        $reason = Reason::find($id);

        if (!$reason) {
            return response()->json([
                'status' => false,
                'message' => 'Reason not found'
            ], 404);
        }

        $reason->delete();

        return response()->json([
            'status' => true,
            'message' => 'Reason deleted successfully'
        ]);
    }

    public function byDepartment($departmentId)
    {
        $reasons = Reason::where('department_id', $departmentId)
                        ->where('status', 'active')
                        ->get();

        return response()->json([
            'status' => true,
            'data' => $reasons
        ]);
    }
}