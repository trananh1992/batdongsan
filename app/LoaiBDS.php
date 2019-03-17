<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LoaiBDS extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'loaibds';
    
    protected $fillable = [
        'ten_loaibds',
    ];
}
