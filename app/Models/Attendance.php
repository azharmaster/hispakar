<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'attendance';

    protected $fillable = [
        'aptid',
        'docid',
        'patientid',
        'status',
        'queueid',
    ];

    public $timestamps = false;
}
