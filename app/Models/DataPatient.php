<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datapatient extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'datapatient';

    protected $fillable = [
        'bpm',
        'spo2',
        'pi', 
    ];

    public $timestamps = false;
}
