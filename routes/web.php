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
		Route::get('huyen/{id}','DiadiemController@gethuyen');
		Route::get('xa/{idtinh}/{idhuyen}','DiadiemController@getxa');
		Route::post('themtinh','DiadiemController@postthemtinh');
		Route::post('suatinh','DiadiemController@postsuatinh');
		Route::get('xoatinh/{id}','DiadiemController@getxoatinh');
		Route::post('themhuyen','DiadiemController@postthemhuyen');
		Route::post('suahuyen','DiadiemController@postsuahuyen');
		Route::get('xoahuyen/{idtinh}/{idhuyen}','DiadiemController@getxoahuyen');
		Route::post('themxa','DiadiemController@postthemxa');
		Route::post('suaxa','DiadiemController@postsuaxa');
		Route::get('xoaxa/{idtinh}/{idhuyen}/{idxa}','DiadiemController@getxoaxa');
		Route::get('getdshuyen/{idtinh}','DiadiemController@getdshuyen');
		Route::get('getdsxa/{idtinh}/{idhuyen}','DiadiemController@getdsxa');
	});
	Route::group(['prefix'=>'tintuc'],function(){
		Route::get('/','TintucController@danhsach');
		Route::get('them','TintucController@getthemtintuc');
		Route::post('them','TintucController@postthemtintuc');
		Route::get('sua/{id}','TintucController@getsuatintuc');
		Route::post('sua','TintucController@postsuatintuc');
		Route::get('xoa/{id}','TintucController@getxoatintuc');
	});
	Route::group(['prefix'=>'danhmuc'],function(){
		Route::get('huong','DanhMucController@huong');
		Route::get('getdshuong','DanhMucController@getdshuong');
		Route::post('addhuong','DanhMucController@addHuong');
		Route::get('loaibds','DanhMucController@loaibds');
		Route::get('loaidat','DanhMucController@loaidat');
		Route::get('loainha','DanhMucController@loainha');
		Route::get('loaitin','DanhMucController@loaitin');
		Route::get('loaigiayto','DanhMucController@loaigiayto');
		Route::get('loaivp','DanhMucController@loaivp');
	});

});
Route::get('saveimage', function () {
    return view('admin.test');
});
Route::post('saveimage','TintucController@saveimage');

Route::get('createuser','UserController@create');
Route::post('dangnhap','UserController@postdangnhap');
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


Route::get('show','NhadatController@show');
Route::get('add','NhadatController@create');
Route::post('add','NhadatController@store');
Route::get('nhadat','NhadatController@index');
Route::get('edit/{id}','NhadatController@edit');
Route::post('edit/{id}','NhadatController@update');
Route::delete('{id}','NhadatController@destroy');
