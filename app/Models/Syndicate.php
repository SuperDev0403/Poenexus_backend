<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syndicate extends Model
{
    use HasFactory;
    protected $table = 'syndicate';

    protected $fillable = [
        'UID', 'NAME', 'LOCATION', 'RANK', 'TIER', 'CRAFT',
    ];

    public $timestamps = false;
}