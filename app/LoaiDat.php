<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LoaiDat extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'loaidat';
    
    protected $fillable = [
        'ten_loaidat',
    ];
}
