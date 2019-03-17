<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LoaiGiayTo extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'loaigiayto';
    
    protected $fillable = [
        'ten_loaigiayto',
    ];
}
