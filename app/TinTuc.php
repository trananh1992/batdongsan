<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TinTuc extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'tintuc';
    
    protected $fillable = [
        'tieu_de','noi_dung','dien_tich','ngay_tao','gia','so_pngu','so_pvs','dia_chi','id_diadiem','id_loaitin','id_huong','id_loaidat','id_loaitin','id_user','id_huong','id_loaigiayto','id_loaivp','id_loainha','toado',
    ];
}
