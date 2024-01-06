<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spo2 extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'spo2';

    protected $fillable = [
        'Value',
        'Date_created',
    ];

}
