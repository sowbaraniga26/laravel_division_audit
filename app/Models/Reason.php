<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $fillable = [
        'department_id',
        'reason',
        'status'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function audits()
    {
        return $this->hasMany(DivisionAudit::class);
    }
}
