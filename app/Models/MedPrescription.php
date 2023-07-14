<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedPrescription extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'medprescription';

    protected $fillable = [
        'aptid',
        'name',
        'qty',
        'desc',
        'price',
        'medicineid',
        'docid',
        'patientid',
    ];

    public $timestamps = false;
}
