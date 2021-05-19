<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $fillable = [
        'id','reqTS', 'sellObjId', 'sellUid', 'sellerId', 'sellIgn', 'buyerId', 'buyIgn','converted', 'notified', 'noteTS','completed','compTS', 'buyHasReq','buyHasReqTS',
    ];

    public $timestamps = false;
}