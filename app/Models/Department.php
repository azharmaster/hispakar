<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'department';

    protected $fillable = [
        'name',
        'desc',
       
    ];

    public $timestamps = false;
}
