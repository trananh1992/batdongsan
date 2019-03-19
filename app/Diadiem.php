<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DiaDiem extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'diadiem';
    
    protected $fillable = [
        'ten', 'huyen',
    ];
    public function dshuyen()
    {
    	return $this->embedsMany('App\QuanHuyen');
    }

}

