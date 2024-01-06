<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bpm extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'bpm';

    protected $fillable = [
        'Value',
        'Date_created',
    ];
}
