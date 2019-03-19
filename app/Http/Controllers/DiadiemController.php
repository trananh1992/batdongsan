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
    public function postsuatinh($id,Request $request)
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
                $tinh = Tinh::where('_id',$id)->update(array('ten' => $request->tentinh));
                return response()->json(['success'=>'Chỉnh sửa tên tỉnh thành công']); 
            }           
        }
        return response()->json(['error'=>$validator->errors()->all()]);
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
    { //return $request->all();
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
            }//$search->update(array('huyen.'.$i.'.ten' => $request->tenhuyenedit));
        }
    }
    public function postxoahuyen(Request $request)
    {                
        $search = Diadiem::where('_id',$request->idtinh);
        $diadiem = $search->get();
        $huyenmoi = array();
        foreach ($diadiem as $dd) {
            if(isset($dd->huyen)){                
                $huyen = $dd->huyen;
                $num = sizeof($huyen);
                if($num >0){
                    for ($i=0; $i < $num ; $i++) { 
                        if(isset($huyen[$i]['ten']) && ($huyen[$i]['ten'] != $request->tenhuyen)){
                            array_push($huyenmoi,$huyen[$i]);
                        } 
                    }
                }                        
            }
        }
        if(!empty($huyenmoi)){
            $search->update(array('huyen' => $huyenmoi));
            return response()->json(['success'=>'Xóa huyện thành công']);
        }
        return response()->json(['error'=> ["Lỗi! Không thể xóa"]]);
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
    public function postxoaxa(Request $request)
    {                //return $request->all();
        $search = Diadiem::where('_id',$request->idtinh);
        $diadiem = $search->get();
        $xamoi = array();
        foreach ($diadiem as $dd) {
            if(isset($dd->huyen) ){
                $huyen = $dd->huyen;
                $num = sizeof($huyen);
                if($num > 0){
                    for ($i=0; $i < $num ; $i++) { 
                        if(isset($huyen[$i]['ten']) && $huyen[$i]['ten'] == $request->tenhuyen){
                            if(isset($huyen[$i]['xa']) ){
                                $xa = $huyen[$i]['xa'];                         
                                $num2 = sizeof($xa);
                                if($num2 == 1){
                                    unset($huyen[$i]['xa']);
                                    $search->update(array('huyen' => $huyen));
                                    return response()->json(['success'=>'Xóa xã thành công']);
                                }else{
                                    for ($j=0; $j < $num2 ; $j++) { 
                                        if(isset($xa[$j]['ten']) && $xa[$j]['ten'] != $request->tenxa){
                                            array_push($xamoi,$xa[$j]);
                                        }
                                    }
                                    if(count($xamoi) > 0){
                                        $search->update(array('huyen.'.$i.'.xa' => $xamoi));
                                        return response()->json(['success'=>'Xóa xã thành công']);
                                    }
                                }
                                
                            }   
                        }
                        
                    }
                }                    
            }                    
        }
        return response()->json(['error'=> ["Lỗi! Không thể xóa"]]);
    }
    public function ajaxgetdshuyen($id)
    {
        $diadiem = Diadiem::where('_id',$id)->get();
        $huyen = array();
        foreach ($diadiem as $dd) {
            if(isset($dd->huyen)){
            $h = $dd->huyen;
                $num = sizeof($h);
                if($num >0){
                    for ($i=0; $i < $num ; $i++) { 
                        if(isset($h[$i]['ten'])){
                            array_push($huyen,$h[$i]['ten']);
                        }
                        
                    }
                }

            }
            
        }
        return response()->json($huyen);
    }
    public function ajaxgetdsxa($id, Request $request)
    {

        $tenhuyen = $request->tenhuyen;
        $diadiem = Diadiem::where('_id',$id)->get();
        $dsxa = array();
        foreach ($diadiem as $dd) {
            if(isset($dd->huyen)){
                $huyen = $dd->huyen;
                $num = sizeof($huyen);
                if($num > 0){
                    for ($i=0; $i < $num ; $i++) { 
                        if(isset($huyen[$i]['ten']) && $huyen[$i]['ten'] == $tenhuyen){
                            if(isset($huyen[$i]['xa']) ){
                                $xa = $huyen[$i]['xa'];                         
                                $num2 = sizeof($xa);
                                for ($j=0; $j < $num2 ; $j++) { 
                                    if(isset($xa[$j]['ten']))
                                    array_push($dsxa,$xa[$j]['ten']);                            
                                
                                }
                            }   
                        }                
                    }                
                }
            }            
        }
        return response()->json($dsxa);
    }
    public function insert()
    {
        $dd= new Diadiem();
        $dd->tinh="An Giang";
        $xa1 = new PhuongXa();
        $xa1->ten = "Xã 1";
        $xa2 = new PhuongXa();
        $xa2->ten = "Xã 2";

        $huyen1 = new QuanHuyen();
        $huyen1->ten = "Huyện 1";
        $huyen1->xa=array($xa1,$xa2);
        $huyen2 = new QuanHuyen();
        $huyen2->ten = "Huyện 2";

        $dd->huyen=array($huyen1, $huyen2);
        $dd->save();

        dd($dd);
    }
    public function updatehuyen($tinh)
    {
        $tenhuyen = "Cờ Đỏ";
        $tenmoi = "Thới Lai";
        $search = Diadiem::where('tinh','Cần Thơ');
    	$diadiem = $search->get();
        foreach ($diadiem as $dd) {
            if(isset($dd->huyen)){                
                $huyen = $dd->huyen;
                $num = sizeof($huyen);
                if($num >0){
                    for ($i=0; $i < $num ; $i++) { 
                        if($huyen[$i]['ten'] == $tenhuyen){
                            echo "Đã tìm thấy tên: ".$tenhuyen;
                            $search->update(array('huyen.'.$i.'.ten' => $tenmoi));
                            echo "<br>Đã cập nhật tên thành: ".$tenmoi;
                        } 
                    }
                }else{
                    echo "Tỉnh này hiện tại chưa có huyện";
                }
            }
        }
    }
    public function updatexa($tinh)
    {
        $tenxa = "Xã 2";
        $tenmoi = "An Khánh";
        $search = Diadiem::where('_id',$tinh);
        $diadiem = $search->get();
        foreach ($diadiem as $dd) {
            $huyen = $dd->huyen;
            $num = sizeof($huyen);
            if($num > 0){
                for ($i=0; $i < $num ; $i++) { 
                    echo $i."---";
                    if(!isset($huyen[$i]['xa']) ){
                        echo "Huyện ".$huyen[$i]['ten']." hiện tại chưa có xã<br>";
                    }else{
                        $xa = $huyen[$i]['xa'];                         
                        $num2 = sizeof($xa);
                        echo "Huyện ".$huyen[$i]['ten']." có ".$num2." xã<br>";
                        for ($j=0; $j < $num2 ; $j++) { 
                            echo $xa[$j]['ten']."---";
                            if($xa[$j]['ten'] == $tenxa){
                                echo "Đã tìm thấy tên: ".$tenxa;
                                $search->update(array('huyen.'.$i.'.xa.'.$j.'.ten' => $tenmoi));
                                echo "<br>Đã cập nhật tên thành: ".$tenmoi;
                            }
                        }
                        echo "<br>";

                    }

                }
            }else{
                echo "Tỉnh này hiện tại chưa có huyện";
            }
            
        }
    }
    public function themxa0($tinh)
    {
        $tenxa = "Xã 2";
        $tenmoi = "An Phú";
        $tenhuyen = "Ninh Kiều";
        $search = Diadiem::where('_id',$tinh);
        $diadiem = $search->get();
        foreach ($diadiem as $dd) {
            $huyen = $dd->huyen;
            $num = sizeof($huyen);
            if($num > 0){
                for ($i=0; $i < $num ; $i++) { 
                    if($huyen[$i]['ten'] == $tenhuyen){
                        $xa = $huyen[$i]['xa'];                         
                        $num2 = sizeof($xa);
                        echo "Huyện ".$huyen[$i]['ten']." có ".$num2." xã<br>";
                        $search->update(array('huyen.'.$i.'.xa.'.$num2.'.ten' => $tenmoi));
                        echo "<br>Đã thêm xã tên : ".$tenmoi;
                            
                    }
                }

            }else{
                echo "Tỉnh này hiện tại chưa có huyện";
            }
        }
    }
    public function test()
    {

        $diadiem = Diadiem::where('_id',$tinh)->get();
        foreach ($diadiem as $dd) {
            $huyen = $dd->huyen;
            $num = sizeof($huyen);
            if($num > 0){
                for ($i=0; $i < $num ; $i++) { 
                    echo $i."---";
                    if(!isset($huyen[$i]['xa']) ){
                        echo "Huyện ".$huyen[$i]['ten']." hiện tại chưa có xã<br>";
                    }else{
                        $xa = $huyen[$i]['xa'];                         
                        $num2 = sizeof($xa);
                        echo "Huyện ".$huyen[$i]['ten']." có ".$num2." xã<br>";
                        for ($j=0; $j < $num2 ; $j++) { 
                            echo $xa[$j]['ten']."---";
                            if($xa[$j]['ten'] == $tenxa){
                                echo "Đã tìm thấy tên: ".$tenxa;
                                echo "<br>Đã cập nhật tên thành: ".$tenmoi;
                            }
                        }
                        echo "<br>";

                    }

                }
            }else{
                echo "Tỉnh này hiện tại chưa có huyện";
            }
            
        }
        // $diadiem = $search->get();
        // foreach ($diadiem as $dd) {
        //     $huyen = $dd->huyen;
        //     $num = sizeof($huyen);
        //     if($num > 0){
        //         for ($i=0; $i < $num ; $i++) { 
        //             if($huyen[$i]['ten'] !== null){
        //                 if(isset($huyen[$i]['xa'])){
        //                     $xa = $huyen[$i]['xa'];                         
        //                     $num2 = sizeof($xa);
        //                     if($num2 > 0){
        //                         for ($j=0; $j < $num2 ; $j++) { 
        //                             if($xa[$j]['ten'] == null){
        //                                 for ($k=$j; $k < $num2; $k++) { 
        //                                      echo $xa[$k]['ten']; 

        //                                 }
        //                             }
        //                         }
        //                     }    
        //                 }
                                            
                            
        //             }
        //         }

        //     }else{
        //         echo "Tỉnh này hiện tại chưa có huyện";
        //     }
        // }
        // $search->delete();
        // $search = Diadiem::where('tinh',"Cần Thơ")->get();
        // $search->delete(array( 'huyen.0.ten' => 'Phong Điền'));
        //dd($search);
    }
}
