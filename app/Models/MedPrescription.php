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

    //nurse profile for total patient details
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patientid'); // Assuming patientid is the foreign key column in medprescription table
    }

    public function medrecord() //use in paymentList page 
    {
        return $this->belongsTo(Medrecord::class);
    }

}
