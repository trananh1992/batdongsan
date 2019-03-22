<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LoaiNha extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'danhmuc';

}
