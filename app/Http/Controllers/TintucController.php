<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tintuc;
use App\Tinh;
use App\DanhMuc;

class TintucController extends Controller
{
    public function hienthi($idtin)
    {
        $tintuc=Tintuc::find($idtin);
        return view('front.pages.tintuc.chitiet',compact('tintuc'));
    }
    public function danhsach()
    {
        $tintuc=Tintuc::all();
        return view('admin.pages.tintuc.danhsach',compact('tintuc'));
    }
    public function getthemtintuc()
    {
        $tinh = Tinh::all();
        $danhmuc = DanhMuc::all();
        return view('admin.pages.tintuc.them',compact(['tinh','danhmuc']));
    }
    public function postthemtintuc(Request $request)
    {
        $tin = new Tintuc();
        $tin->dmtin = $request->dmtin; 
        $tin->loaitin = $request->loaitin; 
        //Get tỉnh huyện xã
        $tinh = Tinh::find($request->tinh);
        $huyen = $tinh->dshuyen->where('_id',$request->huyen)->first();
        $xa = $huyen->dsxa->where('_id',$request->xa)->first();
        $tin->tinh = $tinh->ten; 
        $tin->huyen = $huyen->ten; 
        $tin->xa = $xa->ten;
        $tin->tenduong = $request->tenduong;
        if($request->loaihinhcanho != '0'){
            $tin->loaihinhcanho = $request->loaihinhcanho;
        }
        if($request->loaihinhnhao != '0'){          
            $tin->loaihinhnhao = $request->loaihinhnhao;
        }
        if($request->loaihinhnhao != '0'){ 
            $tin->loaihinhvanphong = $request->loaihinhvanphong; 
        }
        if($request->nohau != ''){ 
            $tin->nohau = $request->nohau; 
        }
        $tin->banla = $request->banla; 
        $tin->gia = $request->gia; 

        if($request->pngu != ''){ 
            $tin->pngu = $request->pngu; 
        }
        if($request->pvsinh != ''){ 
            $tin->pvsinh = $request->pvsinh; 
        }
        $tin->dientich = $request->dientich;
        $tin->huong = $request->huong;
        $tin->ddnhadat = $request->ddnhadat;
        $tin->gtpl = $request->gtpl;
        $tin->tieude = $request->tieude;
        $tin->noidung = $request->noidung;   
        $images=array(); 
        if($files=$request->file('hinhanh')){
            foreach($files as $file){
                $imgdata = base64_encode(file_get_contents($file)); 
                $images[]=$imgdata;  
            }
            $tin->hinhanh = $images;
        }
        $tin->save();
        return redirect('admin/tintuc/them')->with('success', 'Thêm tin tức thành công');
    }
    public function postsuatintuc(Request $request)
    {
        $id = $request->id;
        $tin = Tintuc::find($id);
        $tin->dmtin = $request->dmtin; 
        $tin->loaitin = $request->loaitin; 
        //Get tỉnh huyện xã
        $tinh = Tinh::find($request->tinh);
        $huyen = $tinh->dshuyen->where('_id',$request->huyen)->first();
        $xa = $huyen->dsxa->where('_id',$request->xa)->first();
        $tin->tinh = $tinh->ten; 
        $tin->huyen = $huyen->ten; 
        $tin->xa = $xa->ten;
        $tin->tenduong = $request->tenduong;
        if($request->loaihinhcanho != '0'){
            $tin->loaihinhcanho = $request->loaihinhcanho;
        }
        if($request->loaihinhnhao != '0'){          
            $tin->loaihinhnhao = $request->loaihinhnhao;
        }
        if($request->loaihinhnhao != '0'){ 
            $tin->loaihinhvanphong = $request->loaihinhvanphong; 
        }
        if($request->nohau != ''){ 
            $tin->nohau = $request->nohau; 
        }
        $tin->banla = $request->banla; 
        $tin->gia = $request->gia; 

        if($request->pngu != ''){ 
            $tin->pngu = $request->pngu; 
        }
        if($request->pvsinh != ''){ 
            $tin->pvsinh = $request->pvsinh; 
        }
        $tin->dientich = $request->dientich;
        $tin->huong = $request->huong;
        $tin->ddnhadat = $request->ddnhadat;
        $tin->gtpl = $request->gtpl;
        $tin->tieude = $request->tieude;
        $tin->noidung = $request->noidung;   
        $images=array(); 
        if($files=$request->file('hinhanh')){
            foreach($files as $file){
                $imgdata = base64_encode(file_get_contents($file)); 
                $images[]=$imgdata;  
            }
            $tin->hinhanh = $images;
        }
        $tin->save();
        return redirect('admin/tintuc/sua/'.$id)->with('success', 'Cập nhật tin tức thành công');
    }
    public function duyettin($id)
    {
        $tintuc = Tintuc::find($id);
        if(isset($tintuc->duyettin)){
            if($tintuc->duyettin == 0){
                $tintuc->duyettin = 1;
            }else{
                $tintuc->duyettin = 0;
            }
        }else{
            $tintuc->duyettin = 1;
        }
        $tintuc->save();
        return 1;
    }
    public function getsuatintuc($id)
    {
        $tintuc = Tintuc::find($id);
        $tinh = Tinh::all();
        return view('admin.pages.tintuc.sua',compact('tintuc','tinh'));
    }

    public function getxoahinh($idtin, $hinh)
    {
        $tintuc = Tintuc::find($idtin);
        $anh = array();
        foreach ($tintuc->hinhanh as $key => $value) {
            if($key != $hinh){
                array_push($anh, $value);
            }
        }
        $tintuc->hinhanh = $anh;
        $tintuc->save();
        return $anh;
    }
    public function saveimage(Request $request){
        $imgdata = base64_encode(file_get_contents($request->hinhanh)); 
        return $imgdata;
        echo '<img src="data:image/x-icon;base64,'. $imgdata .'" />';

    }
    public function postedit(Request $request, $id)
    {
        // $this->validate($request, [

        //         'hinhanh' => 'required',
        //         'hinhanh.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        // ]);
        $images=array();
        if($files=$request->file('hinhanh')){
            foreach($files as $file){
                $name=date("Ymd_His")."-".$file->getClientOriginalName();
                $file->move('images',$name);
                $images[]=$name;
            }
        }
        $t = Tintuc::find($id);
        $t->tieude = $request->get('tieude');
        $t->noidung = $request->get('noidung');
        $t->gia = $request->get('gia');
        if($images) {
            $t->hinh_anh=json_encode($images);             
        }    
        $t->save();
        return redirect('tintuc')->with('success', 'Cập nhật tin tức thành công');
    }
}
