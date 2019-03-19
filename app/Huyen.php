<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Huyen extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'tinh';
    
    protected $fillable = [
        'ten',
    ];


    public function dsxa()
    {
    	return $this->embedsMany('App\Xa');
    }
}
