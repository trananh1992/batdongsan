<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LoaiCanHo extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'danhmuc';
    
   
}
