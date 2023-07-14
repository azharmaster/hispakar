<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'patient';

    protected $fillable = [
        'name',
        'ic',
        'email',
        'password',
        'phoneno',
        'address',
        'gender',
        'height',
        'weight',
        'bloodtype',
        'dob',
        'age',
        'status',
    ];

    public $timestamps = false;
}
