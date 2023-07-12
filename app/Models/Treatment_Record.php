<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment_Record extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'treatment_records';

    protected $fillable = [
        'treatmentid',
        'appointmentid',
        'patientid',
        'doctorid',
        'treatment_description',
        'uploads',
        'treatment_date',
        'treatment_time',
        'status',
    ];

    public $timestamps = false;
}
