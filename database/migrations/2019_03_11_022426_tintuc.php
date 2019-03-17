<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tintuc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->create('tintuc', function (Blueprint $collection){
            $collection->index('tieu_de');
            $collection->index('noi_dung');
            $collection->index('dien_tich');
            $collection->index('ngay_tao');
            $collection->index('so_pngu');
            $collection->index('so_pvs');
            $collection->index('dia_chi');
            $collection->index('hinh_anh');
            $collection->index('id_diadiem');
            $collection->index('id_loaitin');
            $collection->index('id_loaidat');
            $collection->index('id_loaitin');
            $collection->index('id_user');
            $collection->index('id_huong');
            $collection->index('id_loaigiayto');
            $collection->index('id_loaivp');
            $collection->index('id_loainha');
            $collection->index('toado');
            $collection->rememberToken();
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->drop('tintuc');
    }
}
