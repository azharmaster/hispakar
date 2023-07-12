<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'prescriptions';

    protected $fillable = [
        'treatment_records_id',
        'patientid',
        'doctorid',
        'deliverytype',
        'deliveryid',
        'prescriptiondate',
        'status',
        'appointmentid',

    ];

    public $timestamps = false;
}
