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

Route::get('/','HomeController@gethomepage');

Route::get('admin', function () {
    return view('admin.pages.dashboard');
});
Route::get('login', function () {
    return view('admin.pages.login');
});

Route::post('search','HomeController@postsearch');
Route::get('getdshuyen/{idtinh}','DiadiemController@getdshuyen');
Route::get('getdsxa/{idtinh}/{idhuyen}','DiadiemController@getdsxa');

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
		Route::get('xoahinh/{idtin}/{hinh}','TintucController@getxoahinh');
		Route::get('duyettin/{idtin}','TintucController@duyettin');
	});
	Route::group(['prefix'=>'danhmuc'],function(){
		Route::get('huong','DanhMucController@huong');
		Route::post('themhuong','DanhMucController@postthemhuong');
		Route::post('suahuong','DanhMucController@postsuahuong');
		Route::get('xoahuong/{idhuong}','DanhMucController@getxoahuong');
		//Loai BDS
		Route::get('loaibds','DanhMucController@loaibds');
		Route::post('themloaibds','DanhMucController@postthemloaibds');
		Route::post('sualoaibds','DanhMucController@postsualoaibds');
		Route::get('xoaloaibds/{idloaibds}','DanhMucController@getxoaloaibds');
		//Loai Tin
		Route::get('loaitin','DanhMucController@loaitin');
		Route::post('themloaitin','DanhMucController@postthemloaitin');
		Route::post('sualoaitin','DanhMucController@postsualoaitin');
		Route::get('xoaloaitin/{idloaitin}','DanhMucController@getxoaloaitin');
		//Loại văn phòng
		Route::get('loaivp','DanhMucController@loaivp');
		Route::post('themloaivp','DanhMucController@postthemloaivp');
		Route::post('sualoaivp','DanhMucController@postsualoaivp');
		Route::get('xoaloaivp/{idloai}','DanhMucController@getxoaloaivp');
		///Loại đất
		Route::get('loaidat','DanhMucController@loaidat');
		Route::post('themloaidat','DanhMucController@postthemloaidat');
		Route::post('sualoaidat','DanhMucController@postsualoaidat');
		Route::get('xoaloaidat/{idloai}','DanhMucController@getxoaloaidat');
		///Loại nhà
		Route::get('loainha','DanhMucController@loainha');
		Route::post('themloainha','DanhMucController@postthemloainha');
		Route::post('sualoainha','DanhMucController@postsualoainha');
		Route::get('xoaloainha/{idloai}','DanhMucController@getxoaloainha');
		///Loai giấy tờ
		Route::get('loaigiayto','DanhMucController@loaigiayto');
		Route::post('themloaigiayto','DanhMucController@postthemloaigiayto');
		Route::post('sualoaigiayto','DanhMucController@postsualoaigiayto');
		Route::get('xoaloaigiayto/{idloai}','DanhMucController@getxoaloaigiayto');
		///Đặc điểm nhà đất
		Route::get('dacdiemnhadat','DanhMucController@dacdiemnhadat');
		Route::post('themdacdiemnhadat','DanhMucController@postthemdacdiemnhadat');
		Route::post('suadacdiemnhadat','DanhMucController@postsuadacdiemnhadat');
		Route::get('xoadacdiemnhadat/{idloai}','DanhMucController@getxoadacdiemnhadat');
		///Loai căn hộ
		Route::get('loaicanho','DanhMucController@loaicanho');
		Route::post('themloaicanho','DanhMucController@postthemloaicanho');
		Route::post('sualoaicanho','DanhMucController@postsualoaicanho');
		Route::get('xoaloaicanho/{idloai}','DanhMucController@getxoaloaicanho');
	});
});

Route::get('dangky', function () {
	    return view('dangky');
	});
Route::get('saveimage', function () {
    return view('admin.test');
});
Route::post('saveimage','TintucController@saveimage');

Route::get('createuser','UserController@create');
Route::post('dangnhap','UserController@postdangnhap');
//hiển thị tin tức
Route::get('tintuc/{idtin}','TintucController@hienthi');

Route::get('newtest','TestController@newtest');
Route::get('testinsert','TestController@insert');
Route::get('testget','TestController@index');
Route::get('test','TestController@test0');
Route::get('updatehuyen/{tinh}','TestController@updatehuyen');
Route::get('themhuyen/{tinh}','TestController@themhuyen');
Route::get('updatexa/{tinh}','TestController@updatexa');
Route::get('themxa/{tinh}','TestController@themxa');

Route::get('/tinh','DiadiemController@gettinh');



Route::get('show','NhadatController@show');
Route::get('add','NhadatController@create');
Route::post('add','NhadatController@store');
Route::get('nhadat','NhadatController@index');
Route::get('edit/{id}','NhadatController@edit');
Route::post('edit/{id}','NhadatController@update');
Route::delete('{id}','NhadatController@destroy');
