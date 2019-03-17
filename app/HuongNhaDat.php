<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class HuongNhaDat extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'huongnhadat';
    
    protected $fillable = [
        'ten_huong',
    ];
}
