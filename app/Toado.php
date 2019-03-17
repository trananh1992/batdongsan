<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class HuongNhaDat extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'toado';
    
    protected $fillable = [
        'kinh_do', 'vi_do',
    ];
}
