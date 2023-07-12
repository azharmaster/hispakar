<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'medicines';

    protected $fillable = [
        'medicinecost',
        'description',
        'status',
    ];

    public $timestamps = false;
}
