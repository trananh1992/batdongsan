<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'diadiem'],function(){
		Route::get('/','DiadiemController@getdiadiem');
		Route::get('themtinh','DiadiemController@getthemtinh');
		Route::get('ch','DiadiemController@checktenxa');
		Route::post('themtinh','DiadiemController@postthemtinh');
		Route::post('suatinh/{id}','DiadiemController@postsuatinh');
		Route::post('themhuyen','DiadiemController@postthemhuyen');
		Route::post('suahuyen','DiadiemController@postsuahuyen');
		Route::post('xoahuyen','DiadiemController@postxoahuyen');
		Route::post('themxa','DiadiemController@postthemxa');
		Route::post('suaxa','DiadiemController@postsuaxa');
		Route::post('xoaxa','DiadiemController@postxoaxa');
		Route::get('ajaxgetdshuyen/{id}','DiadiemController@ajaxgetdshuyen');
		Route::get('ajaxgetdsxa/{id}','DiadiemController@ajaxgetdsxa');
	});
	Route::group(['prefix'=>'danhmuc'],function(){
		Route::get('huong','DanhMucController@huong');
		Route::post('addhuong','DanhMucController@addHuong');
		Route::get('loaibds','DanhMucController@loaibds');
		Route::get('loaidat','DanhMucController@loaidat');
		Route::get('loainha','DanhMucController@loainha');
		Route::get('loaitin','DanhMucController@loaitin');
		Route::get('loaigiayto','DanhMucController@loaigiayto');
		Route::get('loaivp','DanhMucController@loaivp');
	});
});


//hiển thị tin tức
Route::get('tintucchitiet','TintucController@hienthi');

Route::get('newtest','TestController@newtest');
Route::get('testinsert','TestController@insert');
Route::get('testget','TestController@index');
Route::get('test','TestController@test0');
Route::get('updatehuyen/{tinh}','TestController@updatehuyen');
Route::get('themhuyen/{tinh}','TestController@themhuyen');
Route::get('updatexa/{tinh}','TestController@updatexa');
Route::get('themxa/{tinh}','TestController@themxa');

Route::get('/tinh','DiadiemController@gettinh');

Route::get('/', function () {
    return view('front.pages.homepage');
});
Route::get('homepage', function () {
    return view('front.pages.homepage');
});

Route::get('admin', function () {
    return view('admin.pages.dashboard');
});
Route::get('login', function () {
    return view('admin.pages.login');
});
Route::get('tintuc','TintucController@index');
Route::get('tintucadd','TintucController@getadd');
Route::post('tintucadd','TintucController@postadd');
Route::get('tintucedit/{id}','TintucController@getedit');
Route::post('tintucedit/{id}','TintucController@postedit');

Route::get('show','NhadatController@show');
Route::get('add','NhadatController@create');
Route::post('add','NhadatController@store');
Route::get('nhadat','NhadatController@index');
Route::get('edit/{id}','NhadatController@edit');
Route::post('edit/{id}','NhadatController@update');
Route::delete('{id}','NhadatController@destroy');
