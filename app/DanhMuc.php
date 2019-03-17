<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DanhMuc extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'danhmuc';
    
    protected $fillable = [
        'huong','loaidat','loaigiayto','loaivanphong','loaitin','loaibatdongsan','loainha'
    ];

}

