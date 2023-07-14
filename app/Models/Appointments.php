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
        'patientid',
        'docid',
        'deptid',
        'date',
        'time',
        'status',
    ];

    public $timestamps = false;
}
