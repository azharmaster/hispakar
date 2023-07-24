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

}
