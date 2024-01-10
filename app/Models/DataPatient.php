<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPatient extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'datapatient';

    protected $fillable = [
        'bpm',
        'spo2',
        'pi', 
        'Value1',
        'Value2',
        'Value3',
    ];

    public $timestamps = false;
}
