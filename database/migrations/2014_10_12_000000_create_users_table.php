<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->create('users', function (Blueprint $collection){
            $collection->index('hoten');
            $collection->index('username');
            $collection->unique('email');
            $collection->index('password');
            $collection->index('sdt');
            $collection->index('quantam');
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
        Schema::connection('mongodb')->drop('users');
    }
}
