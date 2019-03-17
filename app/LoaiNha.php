<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LoaiNha extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'loainha';
    
    protected $fillable = [
        'ten_loainha',
    ];
}
