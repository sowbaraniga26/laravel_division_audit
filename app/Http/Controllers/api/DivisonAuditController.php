<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DivisonAudit;

class DivisonAuditController extends Controller
{
    // ✅ Get all audits
    public function index(Request $request)
    {
        $query = DivisonAudit::with(['location', 'department', 'reason']);

        // 🔍 Filters (optional)
        if ($request->location_id) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->department_id) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->reason_id) {
            $query->where('reason_id', $request->reason_id);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->from_date && $request->to_date) {
            $query->whereBetween('audit_date', [$request->from_date, $request->to_date]);
        }

        $audits = $query->latest()->get();

        return response()->json([
            'status' => true,
            'data' => $audits
        ]);
    }

    // ✅ Store new audit
    public function store(Request $request)
    {
        $request->validate([
            'location_id'   => 'required|exists:locations,id',
            'department_id' => 'required|exists:departments,id',
            'reason_id'     => 'required|exists:reasons,id',
            'audit_date'    => 'required|date',
            'status'        => 'required|in:open,closed',
            'remarks'       => 'nullable|string'
        ]);

        $audit = DivisonAudit::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Audit created successfully',
            'data' => $audit
        ]);
    }

    // ✅ Show single audit
    public function show($id)
    {
        $audit = DivisonAudit::with(['location', 'department', 'reason'])->find($id);

        if (!$audit) {
            return response()->json([
                'status' => false,
                'message' => 'Audit not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $audit
        ]);
    }

    // ✅ Update audit
    public function update(Request $request, $id)
    {
        $audit = DivisonAudit::find($id);

        if (!$audit) {
            return response()->json([
                'status' => false,
                'message' => 'Audit not found'
            ], 404);
        }

        $request->validate([
            'location_id'   => 'required|exists:locations,id',
            'department_id' => 'required|exists:departments,id',
            'reason_id'     => 'required|exists:reasons,id',
            'audit_date'    => 'required|date',
            'status'        => 'required|in:open,closed',
            'remarks'       => 'nullable|string'
        ]);

        $audit->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Audit updated successfully',
            'data' => $audit
        ]);
    }

    // ✅ Delete audit
    public function destroy($id)
    {
        $audit = DivisonAudit::find($id);

        if (!$audit) {
            return response()->json([
                'status' => false,
                'message' => 'Audit not found'
            ], 404);
        }

        $audit->delete();

        return response()->json([
            'status' => true,
            'message' => 'Audit deleted successfully'
        ]);
    }

    public function summary()
    {
        return response()->json([
            'total' => DivisonAudit::count(),
            'open'  => DivisonAudit::where('status', 'open')->count(),
            'closed'=> DivisonAudit::where('status', 'closed')->count(),
        ]);
    }
}