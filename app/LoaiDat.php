<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LoaiDat extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'danhmuc';

}
