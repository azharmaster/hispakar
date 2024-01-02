<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'room';

    protected $fillable = [
        'name',
        'type',
        'desc',
        'status',
    ];

    public $timestamps = false;

    // Room.php
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'staff_id');
    }

}
