<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LoaiGiayTo extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'danhmuc';
    
}
