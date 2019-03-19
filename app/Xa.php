<?php

namespace App;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Xa extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'tinh';
    
    protected $fillable = [
        'ten',
    ];


}
