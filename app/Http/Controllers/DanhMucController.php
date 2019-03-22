<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DanhMuc;
use App\HuongNhaDat;
use App\LoaiBDS;
use App\LoaiDat;
use App\LoaiGiayTo;
use App\LoaiNha;
use App\LoaiTin;
use App\LoaiVanPhong;
use App\LoaiCanHo;
use App\DacDiemNhaDat;

class DanhMucController extends Controller
{

//Danh muc Huong
    public function huong()
    {
        $huong=DanhMuc::where('ten','DanhMucHuong')->first();
        $dshuong=array();
        if(isset($huong->dshuong)){
            $dshuong=$huong->dshuong;   
        }
        return view('admin.pages.danhmuc.huong',compact('dshuong'));
    }

    //Kiểm tra hướng có hay chưa   
    public function checktenhuong($tenhuong)
    {
        $huong = DanhMuc::where('ten','DanhMucHuong')->first();
        if(isset($huong->dshuong))
        foreach ($huong->dshuong as $h) {
            if($h->tenhuong == $tenhuong){
                return 1;
            }
        } return 0;
    }

//Them huong
public function postthemhuong(Request $request)
    { 
        $validator = Validator::make($request->all(),
            [
                'tenhuong'=>'required',
            ],
            [
                'tenhuong.required' => 'Vui lòng nhập tên tỉnh',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenhuong($request->tenhuong);
            if($checkten == 1)
            {
                return response()->json(['error'=> ["Tên hướng đã tồn tại"]]);
            }
            else{
                $danhmuc = DanhMuc::where('ten','DanhMucHuong')->first();
                if(!isset($danhmuc->dshuong)){
                    $danhmuc = new DanhMuc();
                    $danhmuc->ten='DanhMucHuong';
                    $danhmuc->save();
                }
                $huong = new HuongNhaDat();
                $huong->tenhuong=$request->tenhuong;
                $danhmuc->dshuong()->save($huong);
                return response()->json(['success'=>'Thêm  hướng thành công']);
            }            
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
// Sửa hướng    
 public function postsuahuong(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'tenhuong'=>'required',
            ],
            [
                'tenhuong.required' => 'Vui lòng nhập tên hướng',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenhuong($request->tenhuong);
            if($checkten == 1){
                return response()->json(['error'=> ["Tên hướng đã tồn tại"]]);
            }else{                
                $dshuong = DanhMuc::where('ten','DanhMucHuong')->first()->dshuong;
                $huong = $dshuong->where('_id',$request->idhuong)->first();
                $huong->tenhuong = $request->tenhuong;
                $huong->save();
            return response()->json(['success'=>'Sửa hướng thành công']);    
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

//Xóa hướng
    public function getxoahuong($idhuong){
        $dshuong = DanhMuc::where('ten','DanhMucHuong')->first()->dshuong;
        $huong = $dshuong->where('_id',$idhuong)->first();
        $huong->delete();
        return response()->json(['success'=>'Xóa hướng thành công']);
    }

/////// LOAI BAT DONG SAN //////

    //Danh muc Huong
    public function loaibds()
    {
        $danhmuc=DanhMuc::where('ten','DanhMucLoaiBDS')->first();
        $dsdanhmuc=array();
        if(isset($danhmuc->dsloaibds)){
            $dsdanhmuc=$danhmuc->dsloaibds;   
        }
        return view('admin.pages.danhmuc.loaibds',compact('dsdanhmuc'));
    }

    //Kiểm tra loại bất động sản   
    public function checktenloaibds($tenloaibds)
    {
        $danhmuc = DanhMuc::where('ten','DanhMucLoaiBDS')->first();
        if(isset($danhmuc->dsloaibds))
        foreach ($danhmuc->dsloaibds as $h) {
            if($h->tenloaibds == $tenloaibds){
                return 1;
            }
        } return 0;
    }

    //Thêm hướng mới
        public function postthemloaibds(Request $request)
    { 
        $validator = Validator::make($request->all(),
            [
                'ten'=>'required',
            ],
            [
                'ten.required' => 'Vui lòng nhập tên tỉnh',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloaibds($request->ten);
            if($checkten == 1)
            {
                return response()->json(['error'=> ["Tên loại bất động sản này đã tồn tại"]]);
            }
            else{
                $danhmuc = DanhMuc::where('ten','DanhMucLoaiBDS')->first();
                if(!isset($danhmuc->dsloaibds)){
                    $danhmuc = new DanhMuc();
                    $danhmuc->ten='DanhMucLoaiBDS';
                    $danhmuc->save();
                }
                $loaibds = new LoaiBDS();
                $loaibds->tenloaibds=$request->ten;
                $danhmuc->dsloaibds()->save($loaibds);
                return response()->json(['success'=>'Thêm  loại bất động sản thành công']);
            }            
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
// Sửa hướng    
 public function postsualoaibds(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'tendanhmuc'=>'required',
            ],
            [
                'tendanhmuc.required' => 'Vui lòng nhập tên loại bất động sản',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloaibds($request->tendanhmuc);
            if($checkten == 1){
                return response()->json(['error'=> ["Tên loại bất động sản này đã có"]]);
            }else{                
                $dsloaibds = DanhMuc::where('ten','DanhMucLoaiBDS')->first()->dsloaibds;
                $loaibds = $dsloaibds->where('_id',$request->iddanhmuc)->first();
                $loaibds->tenloaibds = $request->tendanhmuc;
                $loaibds->save();
            return response()->json(['success'=>'Sửa loại bất động sản thành công']);     
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

//Xóa hướng
    public function getxoaloaibds($idloaibds){
        $dsloaibds = DanhMuc::where('ten','DanhMucLoaiBDS')->first()->dsloaibds;
        $loaibds = $dsloaibds->where('_id',$idloaibds)->first();
        $loaibds->delete();
        return response()->json(['success'=>'Xóa loại bất động sản thành công thành công']);
    }


/////////////// END BAT DONG SAN

///LOAI TIN /////
/////// LOAI BAT DONG SAN //////

    //Danh muc loại tin
    public function loaitin()
    {
        $danhmuc=DanhMuc::where('ten','DanhMucLoaiTin')->first();
        $dsdanhmuc=array();
        if(isset($danhmuc->dsloaitin)){
            $dsdanhmuc=$danhmuc->dsloaitin;   
        }
        return view('admin.pages.danhmuc.loaitin',compact('dsdanhmuc'));
    }

    //Kiểm tra loại tin   
    public function checktenloaitin($ten)
    {
        $danhmuc = DanhMuc::where('ten','DanhMucLoaiTin')->first();
        if(isset($danhmuc->dsloaitin))
        foreach ($danhmuc->dsloaitin as $h) {
            if($h->tenloaitin == $ten){
                return 1;
            }
        } return 0;
    }

    //Thêm hướng mới
        public function postthemloaitin(Request $request)
    { 
        $validator = Validator::make($request->all(),
            [
                'ten'=>'required',
            ],
            [
                'ten.required' => 'Vui lòng nhập tên loại tin',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloaitin($request->ten);
            if($checkten == 1)
            {
                return response()->json(['error'=> ["Tên loại tin này đã tồn tại"]]);
            }
            else{
                $danhmuc = DanhMuc::where('ten','DanhMucLoaiTin')->first();
                if(!isset($danhmuc->dsloaitin)){
                    $danhmuc = new DanhMuc();
                    $danhmuc->ten='DanhMucLoaiTin';
                    $danhmuc->save();
                }
                $loaitin = new LoaiTin();
                $loaitin->tenloaitin=$request->ten;
                $danhmuc->dsloaitin()->save($loaitin);
                return response()->json(['success'=>'Thêm  loại tin thành công']);
            }            
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
// Sửa hướng    
 public function postsualoaitin(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'tendanhmuc'=>'required',
            ],
            [
                'tendanhmuc.required' => 'Vui lòng nhập tên loại tin',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloaitin($request->tendanhmuc);
            if($checkten == 1){
                return response()->json(['error'=> ["Tên loại tin này đã có"]]);
            }else{                
                $dsloaitin = DanhMuc::where('ten','DanhMucLoaiTin')->first()->dsloaitin;
                $loaitin = $dsloaitin->where('_id',$request->iddanhmuc)->first();
                $loaitin->tenloaitin = $request->tendanhmuc;
                $loaitin->save();
            return response()->json(['success'=>'Sửa loại tin thành công']);     
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

//Xóa hướng
    public function getxoaloaitin($idloai){
        $dsloaitin = DanhMuc::where('ten','DanhMucLoaiTin')->first()->dsloaitin;
        $loaitin = $dsloaitin->where('_id',$idloai)->first();
        $loaitin->delete();
        return response()->json(['success'=>'Xóa loại tin thành công']);
    }


/////////////// END LOAI TIN    

/////// LOAI VAN PHONG//////

    //Danh muc loại văn phòng
    public function loaivp()
    {
        $danhmuc=DanhMuc::where('ten','DanhMucLoaiVP')->first();
        $dsdanhmuc=array();
        if(isset($danhmuc->dsloaivp)){
            $dsdanhmuc=$danhmuc->dsloaivp;   
        }
        return view('admin.pages.danhmuc.loaivp',compact('dsdanhmuc'));
    }

    //Kiểm tra loại tin   
    public function checktenloaivp($ten)
    {
        $danhmuc = DanhMuc::where('ten','DanhMucLoaiVP')->first();
        if(isset($danhmuc->dsloaivp))
        foreach ($danhmuc->dsloaivp as $h) {
            if($h->tenloaivp == $ten){
                return 1;
            }
        } return 0;
    }

    //Thêm hướng mới
        public function postthemloaivp(Request $request)
    { 
        $validator = Validator::make($request->all(),
            [
                'ten'=>'required',
            ],
            [
                'ten.required' => 'Vui lòng nhập tên loại văn phòng',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloaivp($request->ten);
            if($checkten == 1)
            {
                return response()->json(['error'=> ["Tên loại văn phòng này đã tồn tại"]]);
            }
            else{
                $danhmuc = DanhMuc::where('ten','DanhMucLoaiVP')->first();
                if(!isset($danhmuc->dsloaivp)){
                    $danhmuc = new DanhMuc();
                    $danhmuc->ten='DanhMucLoaiVP';
                    $danhmuc->save();
                }
                $loaivp = new LoaiVanPhong();
                $loaivp->tenloaivp=$request->ten;
                $danhmuc->dsloaivp()->save($loaivp);
                return response()->json(['success'=>'Thêm  loại văn phòng thành công']);
            }            
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
// Sửa hướng    
 public function postsualoaivp(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'tendanhmuc'=>'required',
            ],
            [
                'tendanhmuc.required' => 'Vui lòng nhập tên loại văn phòng',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloaivp($request->tendanhmuc);
            if($checkten == 1){
                return response()->json(['error'=> ["Tên loại văn phòng này đã có"]]);
            }else{                
                $dsloaivp = DanhMuc::where('ten','DanhMucLoaiVP')->first()->dsloaivp;
                $loaivp = $dsloaivp->where('_id',$request->iddanhmuc)->first();
                $loaivp->tenloaivp = $request->tendanhmuc;
                $loaivp->save();
            return response()->json(['success'=>'Sửa loại văn phòng thành công']);     
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

//Xóa hướng
    public function getxoaloaivp($idloai){
        $dsloai = DanhMuc::where('ten','DanhMucLoaiVP')->first()->dsloaivp;
        $loai = $dsloai->where('_id',$idloai)->first();
        $loai->delete();
        return response()->json(['success'=>'Xóa loại văn phòng thành công']);
    }


/////////////// END LOAI VAN PHONG    

/////// LOAI DAT/////

    //Danh muc loại đất
    public function loaidat()
    {
        $danhmuc=DanhMuc::where('ten','DanhMucLoaiDat')->first();
        $dsdanhmuc=array();
        if(isset($danhmuc->dsloaidat)){
            $dsdanhmuc=$danhmuc->dsloaidat;   
        }
        return view('admin.pages.danhmuc.loaidat',compact('dsdanhmuc'));
    }

    //Kiểm tra loại tin   
    public function checktenloaidat($ten)
    {
        $danhmuc = DanhMuc::where('ten','DanhMucLoaiDat')->first();
        if(isset($danhmuc->dsloaidat))
        foreach ($danhmuc->dsloaidat as $h) {
            if($h->tenloaidat == $ten){
                return 1;
            }
        } return 0;
    }

    //Thêm hướng mới
        public function postthemloaidat(Request $request)
    { 
        $validator = Validator::make($request->all(),
            [
                'ten'=>'required',
            ],
            [
                'ten.required' => 'Vui lòng nhập tên loại đất',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloaidat($request->ten);
            if($checkten == 1)
            {
                return response()->json(['error'=> ["Tên loại đất này đã tồn tại"]]);
            }
            else{
                $danhmuc = DanhMuc::where('ten','DanhMucLoaiDat')->first();
                if(!isset($danhmuc->dsloaidat)){
                    $danhmuc = new DanhMuc();
                    $danhmuc->ten='DanhMucLoaiDat';
                    $danhmuc->save();
                }
                $loaidat = new LoaiDat();
                $loaidat->tenloaidat=$request->ten;
                $danhmuc->dsloaidat()->save($loaidat);
                return response()->json(['success'=>'Thêm  loại đất thành công']);
            }            
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
// Sửa hướng    
 public function postsualoaidat(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'tendanhmuc'=>'required',
            ],
            [
                'tendanhmuc.required' => 'Vui lòng nhập tên loại đất',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloaidat($request->tendanhmuc);
            if($checkten == 1){
                return response()->json(['error'=> ["Tên loại đất này đã có"]]);
            }else{                
                $dsloaidat = DanhMuc::where('ten','DanhMucLoaiDat')->first()->dsloaidat;
                $loaidat = $dsloaidat->where('_id',$request->iddanhmuc)->first();
                $loaidat->tenloaidat = $request->tendanhmuc;
                $loaidat->save();
            return response()->json(['success'=>'Sửa loại đất thành công']);     
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

//Xóa hướng
    public function getxoaloaidat($idloai){
        $dsloai = DanhMuc::where('ten','DanhMucLoaiDat')->first()->dsloaidat;
        $loai = $dsloai->where('_id',$idloai)->first();
        $loai->delete();
        return response()->json(['success'=>'Xóa loại đất thành công']);
    }


/////////////// END LOAI DAT

/////// LOAI NHA/////

    //Danh muc loại nhà
    public function loainha()
    {
        $danhmuc=DanhMuc::where('ten','DanhMucLoaiNha')->first();
        $dsdanhmuc=array();
        if(isset($danhmuc->dsloainha)){
            $dsdanhmuc=$danhmuc->dsloainha;   
        }
        return view('admin.pages.danhmuc.loainha',compact('dsdanhmuc'));
    }

    //Kiểm tra loại tin   
    public function checktenloainha($ten)
    {
        $danhmuc = DanhMuc::where('ten','DanhMucLoaiNha')->first();
        if(isset($danhmuc->dsloainha))
        foreach ($danhmuc->dsloainha as $h) {
            if($h->tenloainha == $ten){
                return 1;
            }
        } return 0;
    }

    //Thêm hướng mới
        public function postthemloainha(Request $request)
    { 
        $validator = Validator::make($request->all(),
            [
                'ten'=>'required',
            ],
            [
                'ten.required' => 'Vui lòng nhập tên loại nhà',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloaidat($request->ten);
            if($checkten == 1)
            {
                return response()->json(['error'=> ["Tên loại nhà này đã tồn tại"]]);
            }
            else{
                $danhmuc = DanhMuc::where('ten','DanhMucLoaiNha')->first();
                if(!isset($danhmuc->dsloainha)){
                    $danhmuc = new DanhMuc();
                    $danhmuc->ten='DanhMucLoaiNha';
                    $danhmuc->save();
                }
                $loainha = new LoaiNha();
                $loainha->tenloainha=$request->ten;
                $danhmuc->dsloainha()->save($loainha);
                return response()->json(['success'=>'Thêm  loại nhà thành công']);
            }            
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
// Sửa hướng    
 public function postsualoainha(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'tendanhmuc'=>'required',
            ],
            [
                'tendanhmuc.required' => 'Vui lòng nhập tên loại nhà',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloainha($request->tendanhmuc);
            if($checkten == 1){
                return response()->json(['error'=> ["Tên loại nhà này đã có"]]);
            }else{                
                $dsloainha = DanhMuc::where('ten','DanhMucLoaiNha')->first()->dsloainha;
                $loainha = $dsloainha->where('_id',$request->iddanhmuc)->first();
                $loainha->tenloainha = $request->tendanhmuc;
                $loainha->save();
            return response()->json(['success'=>'Sửa loại nhà thành công']);     
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

//Xóa hướng
    public function getxoaloainha($idloai){
        $dsloai = DanhMuc::where('ten','DanhMucLoaiNha')->first()->dsloainha;
        $loai = $dsloai->where('_id',$idloai)->first();
        $loai->delete();
        return response()->json(['success'=>'Xóa loại nhà thành công']);
    }


/////////////// END LOAI NHA    
     
/////// LOAI GIAY TO/////

    //Danh muc loại nhà
    public function loaigiayto()
    {
        $danhmuc=DanhMuc::where('ten','DanhMucLoaiGiayTo')->first();
        $dsdanhmuc=array();
        if(isset($danhmuc->dsloaigiayto)){
            $dsdanhmuc=$danhmuc->dsloaigiayto;   
        }
        return view('admin.pages.danhmuc.loaigiayto',compact('dsdanhmuc'));
    }

    //Kiểm tra loại tin   
    public function checktenloaigiayto($ten)
    {
        $danhmuc = DanhMuc::where('ten','DanhMucLoaiGiayTo')->first();
        if(isset($danhmuc->dsloaigiayto))
        foreach ($danhmuc->dsloaigiayto as $h) {
            if($h->tenloaigiayto == $ten){
                return 1;
            }
        } return 0;
    }

    //Thêm hướng mới
        public function postthemloaigiayto(Request $request)
    { 
        $validator = Validator::make($request->all(),
            [
                'ten'=>'required',
            ],
            [
                'ten.required' => 'Vui lòng nhập tên loại giấy tờ',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloaigiayto($request->ten);
            if($checkten == 1)
            {
                return response()->json(['error'=> ["Tên loại giấy tờ này đã tồn tại"]]);
            }
            else{
                $danhmuc = DanhMuc::where('ten','DanhMucLoaiGiayTo')->first();
                if(!isset($danhmuc->dsloaigiayto)){
                    $danhmuc = new DanhMuc();
                    $danhmuc->ten='DanhMucLoaiGiayTo';
                    $danhmuc->save();
                }
                $loaigiayto = new LoaiNha();
                $loaigiayto->tenloaigiayto=$request->ten;
                $danhmuc->dsloaigiayto()->save($loaigiayto);
                return response()->json(['success'=>'Thêm loại giấy tờ thành công']);
            }            
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
// Sửa hướng    
 public function postsualoaigiayto(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'tendanhmuc'=>'required',
            ],
            [
                'tendanhmuc.required' => 'Vui lòng nhập tên loại giấy tờ',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloaigiayto($request->tendanhmuc);
            if($checkten == 1){
                return response()->json(['error'=> ["Tên loại giấy tờ này đã có"]]);
            }else{                
                $dsloaigiayto = DanhMuc::where('ten','DanhMucLoaiGiayTo')->first()->dsloaigiayto;
                $loaigiayto = $dsloaigiayto->where('_id',$request->iddanhmuc)->first();
                $loaigiayto->tenloaigiayto = $request->tendanhmuc;
                $loaigiayto->save();
            return response()->json(['success'=>'Sửa loại giấy tờ thành công']);     
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

//Xóa hướng
    public function getxoaloaigiayto($idloai){
        $dsloai = DanhMuc::where('ten','DanhMucLoaiGiayTo')->first()->dsloaigiayto;
        $loai = $dsloai->where('_id',$idloai)->first();
        $loai->delete();
        return response()->json(['success'=>'Xóa loại giấy tờ thành công']);
    }


/////////////// END LOAI GIAY TO      
     
/////// DAC DIEM NHA DAT/////

    //Danh muc đặc điểm nhà đất
    public function dacdiemnhadat()
    {
        $danhmuc=DanhMuc::where('ten','DanhMucDacDiemNhaDat')->first();
        $dsdanhmuc=array();
        if(isset($danhmuc->dsdacdiemnhadat)){
            $dsdanhmuc=$danhmuc->dsdacdiemnhadat;   
        }
        return view('admin.pages.danhmuc.dacdiemnhadat',compact('dsdanhmuc'));
    }

    //Kiểm tra loại tin   
    public function checktendacdiemnhadat($ten)
    {
        $danhmuc = DanhMuc::where('ten','DanhMucDacDiemNhaDat')->first();
        if(isset($danhmuc->dsdacdiemnhadat))
        foreach ($danhmuc->dsdacdiemnhadat as $h) {
            if($h->tendacdiemnhadat == $ten){
                return 1;
            }
        } return 0;
    }

    //Thêm hướng mới
        public function postthemdacdiemnhadat(Request $request)
    { 
        $validator = Validator::make($request->all(),
            [
                'ten'=>'required',
            ],
            [
                'ten.required' => 'Vui lòng nhập tên đặc điểm nhà đất',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktendacdiemnhadat($request->ten);
            if($checkten == 1)
            {
                return response()->json(['error'=> ["Tên đặc điểm nhà đất này đã tồn tại"]]);
            }
            else{
                $danhmuc = DanhMuc::where('ten','DanhMucDacDiemNhaDat')->first();
                if(!isset($danhmuc->dsdacdiemnhadat)){
                    $danhmuc = new DanhMuc();
                    $danhmuc->ten='DanhMucDacDiemNhaDat';
                    $danhmuc->save();
                }
                $dacdiemnhadat = new DacDiemNhaDat();
                $dacdiemnhadat->tendacdiemnhadat=$request->ten;
                $danhmuc->dsdacdiemnhadat()->save($dacdiemnhadat);
                return response()->json(['success'=>'Thêm đặc điểm nhà đất thành công']);
            }            
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
// Sửa   
 public function postsuadacdiemnhadat(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'tendanhmuc'=>'required',
            ],
            [
                'tendanhmuc.required' => 'Vui lòng nhập tên đặc điểm nhà đất',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktendacdiemnhadat($request->tendanhmuc);
            if($checkten == 1){
                return response()->json(['error'=> ["Tên đặc điểm nhà đất này đã có"]]);
            }else{                
                $dsdacdiemnhadat = DanhMuc::where('ten','DanhMucDacDiemNhaDat')->first()->dsdacdiemnhadat;
                $dacdiemnhadat = $dsdacdiemnhadat->where('_id',$request->iddanhmuc)->first();
                $dacdiemnhadat->tendacdiemnhadat = $request->tendanhmuc;
                $dacdiemnhadat->save();
            return response()->json(['success'=>'Sửa tên đặc điểm nhà đất thành công']);     
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

//Xóa hướng
    public function getxoadacdiemnhadat($idloai){
        $dsloai = DanhMuc::where('ten','DanhMucDacDiemNhaDat')->first()->dsdacdiemnhadat;
        $loai = $dsloai->where('_id',$idloai)->first();
        $loai->delete();
        return response()->json(['success'=>'Xóa đặc điểm nhà đất thành công']);
    }
/////////////// END DAC DIEM NHA DAT     
    
/////// LOAI CAN HO/////

    //Danh muc loại nhà
    public function loaicanho()
    {
        $danhmuc=DanhMuc::where('ten','DanhMucLoaiCanHo')->first();
        $dsdanhmuc=array();
        if(isset($danhmuc->dsloaicanho)){
            $dsdanhmuc=$danhmuc->dsloaicanho;   
        }
        return view('admin.pages.danhmuc.loaicanho',compact('dsdanhmuc'));
    }

    //Kiểm tra loại tin   
    public function checktenloaicanho($ten)
    {
        $danhmuc = DanhMuc::where('ten','DanhMucLoaiCanHo')->first();
        if(isset($danhmuc->dsloaicanho))
        foreach ($danhmuc->dsloaicanho as $h) {
            if($h->tenloaicanho == $ten){
                return 1;
            }
        } return 0;
    }

    //Thêm hướng mới
        public function postthemloaicanho(Request $request)
    { 
        $validator = Validator::make($request->all(),
            [
                'ten'=>'required',
            ],
            [
                'ten.required' => 'Vui lòng nhập tên loại căn hộ',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloaicanho($request->ten);
            if($checkten == 1)
            {
                return response()->json(['error'=> ["Tên loại căn hộ này đã tồn tại"]]);
            }
            else{
                $danhmuc = DanhMuc::where('ten','DanhMucLoaiCanHo')->first();
                if(!isset($danhmuc->dsloaicanho)){
                    $danhmuc = new DanhMuc();
                    $danhmuc->ten='DanhMucLoaiCanHo';
                    $danhmuc->save();
                }
                $loaicanho = new LoaiCanHo();
                $loaicanho->tenloaicanho=$request->ten;
                $danhmuc->dsloaicanho()->save($loaicanho);
                return response()->json(['success'=>'Thêm loại căn hộ thành công']);
            }            
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
// Sửa hướng    
 public function postsualoaicanho(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'tendanhmuc'=>'required',
            ],
            [
                'tendanhmuc.required' => 'Vui lòng nhập tên loại căn hộ',
            ]);

        if ($validator->passes()) {
            $checkten = $this->checktenloaicanho($request->tendanhmuc);
            if($checkten == 1){
                return response()->json(['error'=> ["Tên loại căn hộ này đã có"]]);
            }else{                
                $dsloaicanho = DanhMuc::where('ten','DanhMucLoaiCanHo')->first()->dsloaicanho;
                $loaicanho = $dsloaicanho->where('_id',$request->iddanhmuc)->first();
                $loaicanho->tenloaicanho = $request->tendanhmuc;
                $loaicanho->save();
            return response()->json(['success'=>'Sửa loại căn hộ thành công']);     
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

//Xóa hướng
    public function getxoaloaicanho($idloai){
        $dsloai = DanhMuc::where('ten','DanhMucLoaiCanHo')->first()->dsloaicanho;
        $loai = $dsloai->where('_id',$idloai)->first();
        $loai->delete();
        return response()->json(['success'=>'Xóa loại căn hộ thành công']);
    }
/////////////// END LOAI CAN HO    
}
