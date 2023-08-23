<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedRecord extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'medrecord';

    protected $fillable = [
        'aptid',
        'serviceid',
        'desc',
        'img',
        'datetime',
        'totalcost',
        'docid',
        'patientid',
    ];

    public $timestamps = false;

    public function doctor()
    {
        return $this->hasMany(Doctor::class, 'docid','id');
    }

    public function doctors()
    {
        return $this->belongsTo(Doctor::class, 'docid');
    }

    public function medservice()
    {
        return $this->belongsTo(Medservice::class, 'serviceid');
    }
    
    // Assuming MedRecord has a relationship with the Appointment model
    public function appointment()
    {
        return $this->belongsTo(Appointments::class, 'appointment_id');
    }

    // Add other relationships with the Patient and Doctor models, if applicable
    // Example:
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patientid');
    }

    public function attendingDoctor()
    {
        return $this->belongsTo(Doctor::class, 'docid');
    }

    public function medPrescription()
    {
        return $this->belongsTo(MedPrescription::class, 'medprescription_id');
    }

    public function medInvoice()
    {
        return $this->hasOne(MedInvoice::class, 'medrecordid');
    }

    public function medprescriptions()
    {
        return $this->hasMany(Medprescription::class, 'medrecordid'); // Use 'medrecordid' as the foreign key
    }

}
