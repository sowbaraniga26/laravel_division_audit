<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DivisionAudit extends Model
{
    protected $fillable = [
        'location_id',
        'department_id',
        'reason_id',
        'audit_date',
        'status',
        'remarks'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }
}
