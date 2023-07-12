<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'patients';

    protected $fillable = [
        'name',
        'ic',
        'noreg',
        'address',
        'notel',
        'email',
        'bloodtype',
        'dob',
        'gender',
    ];

    public $timestamps = false;
}
