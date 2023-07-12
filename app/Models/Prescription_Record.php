<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription_Record extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'prescription_records';

    protected $fillable = [
        'prescription_id',
        'medicine_name',
        'cost',
        'unit',
        'dosage',
        'status',
    ];

    public $timestamps = false;
}
