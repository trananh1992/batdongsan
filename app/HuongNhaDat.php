<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class HuongNhaDat extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'danhmuc';
    
    protected $fillable = [
        'ten_huong',
    ];
}
