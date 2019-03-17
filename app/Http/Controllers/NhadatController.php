<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nhadat;

class NhadatController extends Controller
{
    public function create()
    {
        return view('nhadatnew');
    }
    public function store(Request $request)
    {
        $nd = new Nhadat();
        $nd->ten = $request->get('tennhadat');
        $nd->diachi = $request->get('diachi');
        $nd->dientich = $request->get('dientich');        
        $nd->save();
        return redirect('nhadat')->with('success', 'Thêm nhà đất thành công');
    }
    public function index()
    {
        $nd=Nhadat::all();
        return view('nhadatindex',compact('nd'));
    }
    public function edit($id)
    {
        $nd = Nhadat::find($id);
        return view('nhadatedit',compact('nd','id'));
    }
    public function update(Request $request, $id)
    {
        $nd= Nhadat::find($id);
        $nd->ten = $request->get('tennhadat');
        $nd->diachi = $request->get('diachi');
        $nd->dientich = $request->get('dientich');        
        $nd->save();
        return redirect('nhadat')->with('success', 'Cập nhật nhà đất thành công');
    }
    public function destroy($id)
    {
        $nd = Nhadat::find($id);
        $nd->delete();
        return redirect('nhadat')->with('success','Nhà đất đã được xóa');
    }
}
