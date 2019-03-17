<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LoaiTin extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'loaitin';
    
    protected $fillable = [
        'ten_loaitin',
    ];
}
