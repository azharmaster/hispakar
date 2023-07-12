<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'services';

    protected $fillable = [
        'service_type',
        'servicecharge',
        'description',
        'status',
    ];

    public $timestamps = false;
}
