<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocSchedule extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'docschedule';

    protected $fillable = [
        'docid',
        'day',
        'date',
        'starttime',
        'endtime',
        'status',
       
    ];

    public $timestamps = false;
}
