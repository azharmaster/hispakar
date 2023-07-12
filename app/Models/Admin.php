<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'admin';

    protected $fillable = [
        'adminname',
        'loginid',
        'password',
        'status',
        'usertype',
    ];

    public $timestamps = false;
}
