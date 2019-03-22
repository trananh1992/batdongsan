<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DacDiemNhaDat extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'danhmuc';
    
   
}
