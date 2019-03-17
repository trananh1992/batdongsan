<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TinhTP extends Eloquent
{
    //protected $connection = 'mongodb';
    //protected $collection = 'tinhtp';
    
    protected $fillable = [
        'ten_tinhtp','huyen',
    ];
}
