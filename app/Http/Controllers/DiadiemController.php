<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Tinh;
use App\Huyen;
use App\Xa;
use App\Diadiem;

class DiadiemController extends Controller
{
    public function getdiadiem()
    {
        // $huyen = new Huyen();
        // $huyen->ten = "Ninh Kiều"; 
        // $t = new Tinh();
        // $t->ten = "Cần Thơ";
        // $t->save();
        // $t->dshuyen()->save($huyen);
        $tinh=Tinh::all();
        return view('admin.pages.diadiem.tinh',compact('tinh'));
    }
    public function gethuyen($id)
    {
        $tinh=Tinh::find($id);
        return view('admin.pages.diadiem.huyen',compact('tinh'));
    }
    public function getxa($idtinh,$idhuyen)
    {
        $huyen=Tinh::find($idtinh)->dshuyen()->where('_id',$idhuyen)->first();
        return view('admin.pages.diadiem.xa',compact(['huyen','idtinh','idhuyen']));
    }
    public function checktentinh($tentinh)
    {
        $tinh = Tinh::all();
        foreach ($tinh as $t) {
            if($t->ten == $tentinh){
                return 1;
            }
        } return 0;
    }
    public function postthemtinh(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'tentinh'=>'required',
            ],
            [
                'tentinh.required' => 'Vui lòng nhập tên tỉnh',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktentinh($request->tentinh);
            if($checkten == 1)
            {
                return response()->json(['error'=> ["Tên tỉnh đã tồn tại"]]);
            }else{
                $tinh = new Tinh();
                $tinh->ten = $request->tentinh;
                $tinh->save();
                return response()->json(['success'=>'Thêm  tỉnh thành công']);
            }            
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function postsuatinh(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'tentinh'=>'required',
            ],
            [
                'tentinh.required' => 'Vui lòng nhập tên tỉnh',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktentinh($request->tentinh);
            if($checkten == 1)
            {
                return response()->json(['error'=> ["Tên tỉnh đã tồn tại"]]);
            }else{
                $tinh = Tinh::find($request->idtinh)->update(array('ten' => $request->tentinh));
                return response()->json(['success'=>'Chỉnh sửa tên tỉnh thành công']); 
            }           
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function getxoatinh($idtinh)
    {
        $tinh = Tinh::find($idtinh);
        $tinh->delete();
        return response()->json(['success'=>'Xóa tỉnh thành công']);
    }
    public function checktenhuyen($idtinh,$tenhuyen)
    {
        $tinh = Tinh::find($idtinh)->first();
        if(isset($tinh->dshuyen)){
            foreach ($tinh->dshuyen as $key => $value) {
                if($value->ten == $tenhuyen){
                    return 1;
                } 
            }
            
        }return 0;
    }
    public function postthemhuyen(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'tenhuyen'=>'required',
            ],
            [
                'tenhuyen.required' => 'Vui lòng nhập tên huyện',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenhuyen($request->idtinh,$request->tenhuyen);
            if( $checkten == 1){
                return response()->json(['error'=> ["Tên huyện đã tồn tại"]]);                
            }else {
                $huyen = new Huyen();
                $huyen->ten = $request->tenhuyen;
                $tinh = Tinh::find($request->idtinh);
                $tinh->dshuyen()->save($huyen);
                return response()->json(['success'=>'Thêm huyện thành công']);                  
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function postsuahuyen(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'tenhuyen'=>'required',
            ],
            [
                'tenhuyen.required' => 'Vui lòng nhập tên huyện',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenhuyen($request->idtinh,$request->tenhuyen);
            if($checkten == 1){
                return response()->json(['error'=> ["Tên huyện đã tồn tại"]]);
            }
            else{                
                $tinh=Tinh::find($request->idtinh)->dshuyen()->where('_id',$request->idhuyen)->first();
                $tinh->ten = $request->tenhuyen;
                $tinh->save();


                return response()->json(['success'=>'Chỉnh sửa tên huyện thành công']);
            }
        }
    }
    public function getxoahuyen($idtinh,$idhuyen)
    {                
        $huyen = Tinh::find($idtinh)->dshuyen->where('_id',$idhuyen)->first();
        $huyen->delete();
        return response()->json(['success'=>'Xóa huyện thành công']);
    }
    public function checktenxa($idtinh,$idhuyen,$tenxa)
    {
        $tinh = Tinh::find($idtinh)->dshuyen()->where('_id',$idhuyen)->first();
        if(isset($tinh->dsxa)){
            foreach ($tinh->dsxa as $key => $value) {
                if($value->ten == $tenxa){
                    return 1;
                } 
            }            
        }return 0;
    }
    public function postthemxa(Request $request)
    {   
        $validator = Validator::make($request->all(),
            [
                'tenxa'=>'required',
            ],
            [
                'tenxa.required' => 'Vui lòng nhập tên xã',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenxa($request->idtinh,$request->idhuyen,$request->tenxa);
            if( $checkten == 1){
                return response()->json(['error'=> ["Tên xã đã tồn tại"]]); 
            }else {
                $xa = new Xa();
                $xa->ten = $request->tenxa;
                $tinh = Tinh::find($request->idtinh)->dshuyen()->where('_id',$request->idhuyen)->first();
                $tinh->dsxa()->save($xa);
                return response()->json(['success'=>'Thêm xã thành công']);   
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function postsuaxa(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'tenxa'=>'required',
            ],
            [
                'tenxa.required' => 'Vui lòng nhập tên xã',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenxa($request->idtinh,$request->idhuyen,$request->tenxa);
            if($checkten == 1){
                return response()->json(['error'=> ["Tên xã đã tồn tại"]]);
            }
            else{                
                $xa = Tinh::find($request->idtinh)->dshuyen()->where('_id',$request->idhuyen)->first()
                                ->dsxa()->where('_id',$request->idxa)->first();
                $xa->ten = $request->tenxa;
                $xa->save();
                return response()->json(['success'=>'Chỉnh sửa xã thành công']);
            }
        }
    }
    public function getxoaxa($idtinh,$idhuyen,$idxa)
    {                
        $xa = Tinh::find($idtinh)->dshuyen()->where('_id',$idhuyen)->first()
                                ->dsxa()->where('_id',$idxa)->first();
        $xa->delete();
        return response()->json(['success'=>'Xóa xã thành công']);

    }
    public function getdshuyen($idtinh)
    {
        $tinh=Tinh::find($idtinh);
        $huyen = array();
        foreach ($tinh->dshuyen as $key => $value) {
            array_push($huyen, array('id'=>$value->id,'ten'=>$value->ten));
        }
        return $huyen;
    }
    public function getdsxa($idtinh,$idhuyen)
    {
        $tinh=Tinh::find($idtinh)->dshuyen->where('_id',$idhuyen)->first();
        $xa = array();
        foreach ($tinh->dsxa as $key => $value) {
            array_push($xa, array('id'=>$value->id,'ten'=>$value->ten));
        }
        return $xa;
    }
    
}
