<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LoaiVanPhong extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'danhmuc';

}
