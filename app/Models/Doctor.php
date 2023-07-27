<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'doctor';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phoneno',
        'deptid',
        'education',
        'experience',
        'status',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'staff_id', 'staff_id');
    }

}
