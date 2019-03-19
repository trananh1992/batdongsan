<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Tinh extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'tinh';
    
    protected $fillable = [
        'ten',
    ];
    public function dshuyen()
    {
    	return $this->embedsMany('App\Huyen');
    }
}
