<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DanhMuc extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'danhmuc';
    
    public function dshuong()
    {
    	return $this->embedsMany('App\HuongNhaDat');
    }
}

