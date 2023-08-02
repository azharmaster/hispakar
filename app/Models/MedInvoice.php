<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedInvoice extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'medinvoice';

    protected $fillable = [
        'medrecordid',
        'discount',
        'tax',
        'totalcost',
    ];

    public $timestamps = false;

}
