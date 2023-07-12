<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'doctors';

    protected $fillable = [
        'doctorname',
        'mobileno',
        'departmentid',
        'loginid',
        'password',
        'status',
        'education',
        'experience',
        'consultancy_charge',
    ];

    public $timestamps = false;
}
