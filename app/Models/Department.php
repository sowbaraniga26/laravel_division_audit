<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'location_id',
        'name',
        'description'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function reasons()
    {
        return $this->hasMany(Reason::class);
    }

    public function audits()
    {
        return $this->hasMany(DivisionAudit::class);
    }

}
