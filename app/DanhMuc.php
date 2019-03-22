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

public function dsloaibds()
    {
        return $this->embedsMany('App\LoaiBDS');
    }
public function dsloaitin()
    {
        return $this->embedsMany('App\LoaiTin');
    }  
 public function dsloainha()
    {
        return $this->embedsMany('App\LoaiNha');
    }     
public function dsloaidat()
    {
        return $this->embedsMany('App\LoaiDat');
    }    
public function dsloaivp()
    {
        return $this->embedsMany('App\LoaiVanPhong');
    } 
public function dsloaigiayto()
    {
        return $this->embedsMany('App\LoaiGiayTo');
    } 
public function dsloaicanho()
    {
        return $this->embedsMany('App\LoaiCanHo');
    }    
public function dsdacdiemnhadat()
    {
        return $this->embedsMany('App\DacDiemNhaDat');
    }              
}

