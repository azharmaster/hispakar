<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'appointment';

    protected $fillable = [
        'patientid',
        'docid',
        'deptid',
        'date',
        'time',
        'status',
    ];

    public $timestamps = false;

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patientid','id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'docid','id');
    }

    // public function department()
    // {
    //     return $this->belongsTo(Doctor::class, 'deptid','id');
    // }
}
