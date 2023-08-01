<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification_user extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'notification_user';

    protected $fillable = [
        'userid',
        'notification'
    ];

    public $timestamps = false;

}
