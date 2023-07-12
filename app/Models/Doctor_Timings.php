<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor_Timings extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'doctor_timings';

    protected $fillable = [
        'doctorid',
        'start_time',
        'end_time',
        'availble_day',
        'status',
    ];

    public $timestamps = false;
}
