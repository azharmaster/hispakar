<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'rooms';

    protected $fillable = [
        'roomtype',
        'roomno',
        'noofbeds',
        'room_tariff',
        'status',
    ];

    public $timestamps = false;
}
