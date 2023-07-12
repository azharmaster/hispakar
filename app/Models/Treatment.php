<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'treatments';

    protected $fillable = [
        'treatmenttype',
        'treatment_cost',
        'note',
        'status',
    ];

    public $timestamps = false;
}
