<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harvest extends Model
{
    use HasFactory;
    protected $table = 'harvest';

    protected $fillable = [
        'UID', 'SOURCE', 'CRAFT', 'TAG1', 'TAG2', 'TAG3', 'TAG4', 'TAG5', 
    ];

    public $timestamps = false;
}