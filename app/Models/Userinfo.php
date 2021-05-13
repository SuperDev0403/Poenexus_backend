<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    use HasFactory;
    protected $table = 'userinfo';

    protected $fillable = [
        'accountName', 'email', 'irlName', 'discordId', 'tradePoint', 'ign1', 'ign2', 'ign3', 
    ];

    public $timestamps = false;
}