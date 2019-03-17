<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tintuc;

class TintucController extends Controller
{
    public function index()
    {
        $tintuc=Tintuc::all();
        return view('admin.pages.tintuc.list',compact('tintuc'));
    }
    public function getadd()
    {
        return view('admin.pages.tintuc.add');
    }
    public function postadd(Request $request)
    {
        $t = new Tintuc();
        $t->tieu_de = $request->get('tieude');
        $t->noi_dung = $request->get('noidung');
        $t->gia = $request->get('gia');      
        $t->save();
        return redirect('tintucadd')->with('success', 'Thêm tin tức thành công');
    }
    public function getedit($id)
    {
        $tintuc = Tintuc::find($id);
        return view('admin.pages.tintuc.edit',compact('tintuc','id'));
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
        $t->tieu_de = $request->get('tieude');
        $t->noi_dung = $request->get('noidung');
        $t->gia = $request->get('gia');
        if($images) {
            $t->hinh_anh=json_encode($images);             
        }    
        $t->save();
        return redirect('tintuc')->with('success', 'Cập nhật tin tức thành công');
    }
}
