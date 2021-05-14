<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bench extends Model
{
    use HasFactory;
    protected $table = 'bench';

    protected $fillable = [
        'UID', 'CRAFT', 'CRAFT2', 'COST', 'UNIT', 'ITEMS', 'LOCATION',
    ];

    public $timestamps = false;
}