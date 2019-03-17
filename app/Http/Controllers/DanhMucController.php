<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DanhMuc;

class DanhMucController extends Controller
{

    //Danh muc Huong
    public function huong()
    {
        $huong=DanhMuc::all();
        return view('admin.pages.danhmuc.huong',compact('huong'));
    }
    public function getadd()
    {
        return view('admin.pages.tintuc.add');
    }
    public function addHuong(Request $request)
    {
        $huong = new DanhMuc();
        $huong->ten = $request->get('tenhuong'); 
        $huong->save();
        return redirect('huong')->with('success', 'Thêm tin tức thành công');
    }
    

    //Danh muc Loại bất động sản
    public function loaibds()
    {
        $loaibds=DanhMuc::all();
        return view('admin.pages.danhmuc.loaibds',compact('loaibds'));
    }

     //Danh muc Loại Đất
    public function loaidat()
    {
        $loaidat=DanhMuc::all();
        return view('admin.pages.danhmuc.loaidat',compact('loaidat'));
    }
     //Danh muc Loại Nhà
    public function loainha()
    {
        $loainha=DanhMuc::all();
        return view('admin.pages.danhmuc.loainha',compact('loainha'));
    }
    //Danh muc Loại Giấy Tờ
    public function loaigiayto()
    {
        $loaigiayto=DanhMuc::all();
        return view('admin.pages.danhmuc.loaigiayto',compact('loaigiayto'));
    }
    //Danh muc Loại Văn Phòng
    public function loaivp()
    {
        $loaivp=DanhMuc::all();
        return view('admin.pages.danhmuc.loaivp',compact('loaivp'));
    }
     //Danh muc Loại Tin
    public function loaitin()
    {
        $loaitin=DanhMuc::all();
        return view('admin.pages.danhmuc.loaitin',compact('loaitin'));
    }
}
