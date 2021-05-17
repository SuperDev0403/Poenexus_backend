<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;

    protected $table = 'sell';

    protected $fillable = [
        'id','userId', 'mode', 'type', 'ign', 'security', 'collat', 'objid','price_c', 'price_ex', 'timestamp','available',
    ];

    public $timestamps = false;
}