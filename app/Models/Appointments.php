<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'appointments';

    protected $fillable = [
        'appointmenttype',
        'patientid',
        'roomid',
        'departmentid',
        'appointmentdate',
        'appointmenttime',
        'doctorid',
        'status',
        'app_reason',
    ];

    public $timestamps = false;
}
