<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'pi';

    protected $fillable = [
        'Value',
        'Date_created',
    ];
}