<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedService extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'medservice';

    protected $fillable = [
        'type',
        'desc',
        'charge',
    ];

    public $timestamps = false;
}
