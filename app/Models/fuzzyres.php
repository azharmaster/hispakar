<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fuzzyres extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'fuzzyres';

    protected $fillable = [
        'Value1',
        'Value2',
        'Value3',
        'Date_created',
    ];
}
