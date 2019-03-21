@extends('admin.layouts.index')
@section('contentadmin')
@if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
@foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
  @endforeach
<a href="{{ asset('admin/tintuc') }}"><button type="button" class="btn btn-secondary">&laquo; Quay lại</button></a>
<p>
<form method="POST" action="{{ asset('/admin/tintuc/them') }}" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label>Chọn danh mục tin đăng</label>
  <select class="form-control" id="dmtin" name="dmtin">
    <option value="0">---Chọn danh mục tin đăng---</option>
    <option id="dmtin1" value="Căn hộ/Chung cư">Căn hộ/Chung cư</option>
    <option id="dmtin2" value="Nhà ở">Nhà ở</option>
    <option id="dmtin3" value="Đất">Đất</option>
    <option id="dmtin4" value="Văn phòng, mặt bằng kinh doanh">Văn phòng, mặt bằng kinh doanh</option>
    <option id="dmtin5" value="Phòng trọ">Phòng trọ</option>
  </select>
</div>
<div class="form-group" id="divloaitin" style="display: none;">
  <label>Chọn loại tin đăng</label>
  <select class="form-control" id="loaitin" name="loaitin">
    <option value="0">---Chọn loại tin đăng---</option>
    <option id="loaitincanban" value="Cần bán">Cần bán</option>
    <option id="loaitin2" value="Cho thuê">Cho thuê</option>
    <option id="loaitincanmua" value="Cần mua">Cần mua</option>
    <option id="loaitin4" value="Cần thuê">Cần thuê</option>
  </select>
</div>
<div class="form-group" id="divtinh" style="display: none;">
  <label>Chọn tỉnh thành</label>
  <select class="form-control" id="tinh" name="tinh">
    <option value="0">---Chọn tỉnh thành---</option>
    @foreach($tinh as $t)
    <option id="tinh{{$t->id}}" value="{{$t->id}}" >{{$t->ten}}</option>
    @endforeach
  </select>
</div>
<div class="form-group" id="divhuyen" style="display: none;">
  <label>Chọn quận, huyện</label>
  <select class="form-control" id="huyen" name="huyen">

  </select>
</div>
<div class="form-group" id="divxa" style="display: none;">
  <label>Chọn phường, xã</label>
  <select class="form-control" id="xa" name="xa">
  </select>
</div>
  <div class="form-group" id="divtenduong" style="display: none;">
    <label>Số nhà, tên đường</label>
    <input type="text" class="form-control" id="tenduong" name="tenduong">
  </div>
  <div class="form-group"  id="divloaihinhcanho" style="display: none;">
  <label>Chọn loại hình căn hộ</label>
  <select class="form-control" id="loaihinhcanho" name="loaihinhcanho">
    <option value="0">---Chọn loại hình căn hộ---</option>
    <option value="1">Căn hộ</option>
    <option value="2">Condotel</option>
    <option value="3">Duplex</option>
    <option value="4">Penthouse</option>
  </select>
</div>  
<div class="form-group" id="divloaihinhnhao" style="display: none;">
  <label>Chọn loại hình nhà ở</label>
  <select class="form-control" id="loaihinhnhao" name="loaihinhnhao">
    <option value="0">---Chọn loại hình nhà ở---</option>
    <option value="Nhà ở">Nhà ở</option>
    <option value="Biệt thự">Biệt thự</option>
    <option value="Duplex">Duplex</option>
    <option value="Penthouse">Penthouse</option>
  </select>
</div>
  <div class="form-group"  id="divloaihinhvanphong" style="display: none;">
  <label>Chọn loại hình văn phòng</label>
  <select class="form-control" id="loaihinhvanphong" name="loaihinhvanphong">
    <option value="0">---Chọn loại hình văn phòng---</option>
    <option value="1">Shophouse</option>
    <option value="2">Officetel</option>
    <option value="3">Văn phòng, mặt bằng kinh doanh</option>
  </select>
</div>
<div class="form-group" id="divnohau" style="display: none;">
<label class="checkbox-inline"><input type="checkbox" name="nohau" value="Nở hậu"> Nở hậu</label>
</div>
  <div class="form-group" id="divbanla" style="display: none;">
  <label>Bạn là</label><br>
  <label class="radio-inline"><input type="radio" name="banla" value="Cá nhân"> Cá nhân</label><br>
  <label class="radio-inline"><input type="radio" name="banla" value="Môi giới"> Môi giới</label>
</div>
    <div class="form-group" id="divgia" style="display: none;">
    <label>Giá</label>
    <input type="number" class="form-control col-sm-3 col-md-6 col-lg-4" name="gia">
  </div>
<div class="form-group" id="divpngu" style="display: none;">
    <label>Số phòng ngủ</label>
    <input type="number" class="form-control col-sm-3 col-md-6 col-lg-4" name="pngu">
  </div>
  <div class="form-group" id="divpvsinh" style="display: none;">
    <label>Số phòng vệ sinh</label>
    <input type="number" class="form-control col-sm-3 col-md-6 col-lg-4" name="pvsinh">
  </div>
  <div class="form-group"  id="divdientich" style="display: none;">
    <label>Diện tích</label>
    <input type="number" class="form-control col-sm-3 col-md-6 col-lg-4" name="dientich">
  </div>
<div class="form-group" id="divddnhadat" style="display: none;">
  <label>Đặc điểm nhà đất</label> <br>
  <label class="radio-inline"><input type="radio" name="ddnhadat" value="Hẻm xe hơi"> Hẻm xe hơi</label><br>
  <label class="radio-inline"><input type="radio" name="ddnhadat" value="Mặt tiền"> Mặt tiền</label>
</div>

  <div class="form-group"  id="divhuong" style="display: none;">
  <label>Chọn hướng</label>
  <select class="form-control" id="huong" name="huong">
    <option value="0">---Chọn hướng---</option>
    <option value="Đông">Đông</option>
    <option value="Tây">Tây</option>
    <option value="Nam">Nam</option>
    <option value="Bắc">Bắc</option>
  </select>
</div>
  <div class="form-group"  id="divgtpl" style="display: none;">
  <label>Chọn giấy tờ pháp lý</label>
  <select class="form-control" id="gtpl" name="gtpl">
    <option value="0">---Chọn giấy tờ pháp lý---</option>
    <option value="Đã có sổ đỏ/sổ hồng">Đã có sổ đỏ/sổ hồng</option>
    <option value="Đang chờ bàn giao sổ">Đang chờ bàn giao sổ</option>
    <option value="Giấy tay, giấy tờ khác">Giấy tay, giấy tờ khác</option>
  </select>
</div>
  <div class="form-group">
    <label>Tiêu đề tin</label>
    <input type="text" class="form-control" name="tieude">
  </div>
  <div class="form-group">
    <label>Nội dung tin</label>
    <textarea class="form-control" rows="5" id="noidung" name="noidung"></textarea>
  </div>

  <div class="form-group">
    <label>Hình ảnh tin</label>
    <input type="file" class="form-control" name="hinhanh[]" multiple="true">
  </div>
  

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection

@section('script')
<script type="text/javascript">
  var dmtin,loaitin,tinh,huyen,xa;

 CKEDITOR.replace('noidung'); 

// --------------------------------------
 $("#dmtin").change(function(){
  dmtin = $("#dmtin").val();
  if(dmtin != 0){
    $("#loaitin").val("0");
    document.getElementById("divloaitin").style.display = "";
    document.getElementById("divnohau").style.display = "";
    document.getElementById("divhuong").style.display = "";
    document.getElementById("divgtpl").style.display = "";
    document.getElementById("divpngu").style.display = "";
    document.getElementById("divpvsinh").style.display = "";
    document.getElementById("divddnhadat").style.display = "";
    if(dmtin == 'Phòng trọ'){
      document.getElementById("loaitincanban").style.display = "none";
      document.getElementById("loaitincanmua").style.display = "none";
      document.getElementById("divloaihinhcanho").style.display = "none";
      document.getElementById("divloaihinhnhao").style.display = "none";
      document.getElementById("divloaihinhvanphong").style.display = "none";
      document.getElementById("divpngu").style.display = "none";
      document.getElementById("divpvsinh").style.display = "none";
    }else{
      document.getElementById("loaitincanban").style.display = "";
      document.getElementById("loaitincanmua").style.display = "";
    }
    if(dmtin == 'Căn hộ/Chung cư'){
      document.getElementById("divloaihinhcanho").style.display = "";
      document.getElementById("divloaihinhnhao").style.display = "none";
      document.getElementById("divloaihinhvanphong").style.display = "none";
    }
    else if(dmtin == 'Nhà ở'){
      document.getElementById("divloaihinhnhao").style.display = "";
      document.getElementById("divloaihinhcanho").style.display = "none";
      document.getElementById("divloaihinhvanphong").style.display = "none";
    }
    else if(dmtin == 'Văn phòng, mặt bằng kinh doanh'){
      document.getElementById("divloaihinhvanphong").style.display = "";
      document.getElementById("divloaihinhcanho").style.display = "none";
      document.getElementById("divloaihinhnhao").style.display = "none";
    }
    else if(dmtin == 'Đất'){
      document.getElementById("divloaihinhvanphong").style.display = "none";
      document.getElementById("divloaihinhcanho").style.display = "none";
      document.getElementById("divloaihinhnhao").style.display = "none";
      document.getElementById("divddnhadat").style.display = "";
    }
  }else{
    document.getElementById("divloaitin").style.display = "none";
  }  
}); 
 // --------------------------------------
 $("#loaitin").change(function(){
  loaitin = $("#loaitin").val();
  if(loaitin != 0){
    document.getElementById("divtinh").style.display = "";
  }else{
    document.getElementById("divtinh").style.display = "none";
  }  
});
// --------------------------------------
 $("#tinh").change(function(){
  tinh = $('#tinh').val();
  var url = base_url+'admin/diadiem/getdshuyen/'+tinh;
  if(tinh != 0){
    $.ajax({
      type : 'get',
      url : url,
      // data : data,
      dataType : 'json',    
      success:function(data)
      {
        console.log(data);
        if($.isEmptyObject(data.error))
        {
          $('#huyen').empty();
          var huyen = document.getElementById("huyen");
          var option = document.createElement("option");
          option.text = "---Chọn quận, huyện---";
          option.value = '0';
          huyen.add(option);
          for (i = 0; i < data.length; i++) { 
            option = document.createElement("option");
            option.text = data[i]['ten'];
            option.value = data[i]['id'];
            huyen.add(option);
          }
          document.getElementById("divhuyen").style.display = "";
        }
     }
   });
    
  }else{
    document.getElementById("divhuyen").style.display = "none";
  }
});
 $("#huyen").change(function(){
  huyen = $("#huyen").val();
  var url = base_url+'/admin/diadiem/getdsxa/'+tinh+'/'+huyen;
  if(huyen != 0){
    $.ajax({
      type : 'get',
      url : url,
      // data : data,
      dataType : 'json',    
      success:function(data)
      {
        console.log(data);
        if($.isEmptyObject(data.error))
        {
          $('#xa').empty();
          var xa = document.getElementById("xa");
          var option = document.createElement("option");
          option.text = "---Chọn phường, xã---";
          option.value = '0';
          xa.add(option);
          for (i = 0; i < data.length; i++) { 
            option = document.createElement("option");
            option.text = data[i]['ten'];
            option.value = data[i]['id'];
            xa.add(option);
          }
          document.getElementById("divxa").style.display = "";
        }
     }
   });    
  }else{
    document.getElementById("divxa").style.display = "none";
  }
});
 $("#xa").change(function(){
    xa = $("#xa").val();
    if(xa != 0){
      document.getElementById("divtenduong").style.display = "";
    }else{
      document.getElementById("divtenduong").style.display = "none";
    }
});
 $("#tenduong").change(function(){
    tenduong = $("#tenduong").val();
    if(tenduong.length != 0){
      document.getElementById("divbanla").style.display = "";
      document.getElementById("divgia").style.display = "";
      document.getElementById("divpngu").style.display = "";
      document.getElementById("divpvsinh").style.display = "";
      document.getElementById("divdientich").style.display = "";
    }
});
</script>

@endsection