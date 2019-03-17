@extends('admin.layouts.index')

@section('contentadmin')

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
 -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary">Danh sách các tỉnh</h4>
              <button style="float: right;" data-toggle="modal" data-target="#themtinh" class="btn btn-primary btn-md">Thêm tỉnh mới</button> 
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên tỉnh</th>
                      <th>Danh sách huyện</th>
                      <th>Sửa tên tỉnh</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
                  	@foreach($tinh as $t)
                    <tr>
                      <td>{{$i++}}</td>
                      <td id="tentinh{{$t->id}}">{{$t->tinh}}</td>
                      <td><button id="danhsachhuyen{{$t->id}}" value="{{$t->id}}" onclick="danhsachhuyen(this)" class="btn btn-primary a-btn-slide-text">
                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          <span>Danh sách</span>            
                      </button>
                      </td>
                      <td><button id="suatinh{{$t->id}}"  value="{{$t->id}}" onclick="suatinh(this)" class="btn btn-primary a-btn-slide-text">
                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          <span><strong>Chỉnh sửa</strong></span>            
                      </button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>



        <!-- Modal -->
    <div class="modal fade" id="suatinh" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="lineModalLabel">Chỉnh sửa tỉnh</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" >

            <!-- content goes here -->
            <input type="text" id="idtinhedit"  hidden="true">
            <form id="formsuatinh" action="{{ URL::to('admin/diadiem/suatinh')}}" method="POST" enctype="multipart/form-data">
              <div id="ketquasuatinh" >
              </div>
              <table class="table table-striped table-hovered">
              <tr>
              
                <td>Tên tỉnh</td>
                <td><input class="form-control" id="ttinhedit" name="tentinhedit"  placeholder="Tên tỉnh" autofocus/></td>
              </tr>
            </table>
            <div style="float: right;">
                <button type="submit"  class="btn btn-info btnluu" >Lưu lại</button></td>
                <button type="button" class="btn btn-danger btnclose" data-dismiss="modal" role="button">Đóng</button>
              </div>
            </form>     
              
          </div>
        </div>
      </div>
    </div>
<!-- Modal -->
    <div class="modal fade" id="themtinh" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="lineModalLabel">Thêm Tỉnh</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">

            <!-- content goes here -->
            <form id="formthemtinh" action="{{ URL::to('admin/diadiem/themtinh')}}" method="POST" enctype="multipart/form-data">
              <div id="ketquathemtinh" >
              </div>
              <table class="table table-striped table-hovered">
              <tr>
              
                <td>Tên tỉnh</td>
                <td><input class="form-control" id="ttinh" name="tentinh"  placeholder="Tên tỉnh" autofocus/></td>
              </tr>
            </table>
            <div style="float: right;">
                <button type="submit"  class="btn btn-info btnluu">Lưu lại</button></td>
                <button type="button" class="btn btn-danger btnclose" data-dismiss="modal" role="button">Đóng</button>
              </div>
            </form>      

          </div>
          
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="danhsachhuyen" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="lineModalLabel">Danh sách huyện</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" >

            <!-- content goes here -->
            <input type="text" id="idtinh"  hidden="true">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên huyện</th>
                      <th>Danh sách xã</th>
                      <th>Sửa tên huyện</th>
                      <th>Xóa huyện</th>
                    </tr>
                  </thead>   
                  <tbody id="dshuyen">
                    <!-- Hiển thị danh sách các huyện -->

                  </tbody>
                </table>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-success" role="button" data-toggle="modal" data-target="#themhuyen" >Thêm huyện</button>
              <button id="dshuyenclose" type="button" class="btn btn-danger" style="float: right;" data-dismiss="modal"  role="button">Đóng</button>
        </div>
        </div>
      </div>
    </div>
   <!-- Modal -->
    <div class="modal fade" id="themhuyen" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="lineModalLabel">Thêm Huyện</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">

            <!-- content goes here -->
            <form id="formthemhuyen" action="{{ URL::to('admin/diadiem/themhuyen')}}" method="POST" enctype="multipart/form-data">
              <div id="ketquathemhuyen">
              </div>
              <input type="text" id="idtinhhuyen" name="idtinhhuyen"  hidden="true">
              <table class="table table-striped table-hovered">
              <tr>              
                <td>Tên huyện</td>
                <td><input class="form-control" id="thuyen" name="tenhuyen"  placeholder="Tên huyện" autofocus/></td>
              </tr>
            </table>
            <div style="float: right;">
                <button type="submit"  class="btn btn-info btnluu">Lưu lại</button></td>
                <button type="button" class="btn btn-danger btnclose" role="button">Đóng</button>
              </div>
            </form>      

          </div>
          
        </div>
      </div>
    </div>

   <!-- Modal -->
    <div class="modal fade" id="suahuyen" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="lineModalLabel">Chỉnh sửa Huyện</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">

            <!-- content goes here -->
            <form id="formsuahuyen" action="{{ URL::to('admin/diadiem/suahuyen')}}" method="POST" enctype="multipart/form-data">
              <div id="ketquasuahuyen">
              </div>
              <input type="text" id="idtinhhuyenedit" name="idtinhhuyenedit"  hidden="true">
              <input type="text" id="tenhuyenold" name="tenhuyenold"  hidden="true">
              <table class="table table-striped table-hovered">
              <tr>              
                <td>Tên huyện</td>
                <td><input class="form-control" id="thuyenedit" name="tenhuyenedit"  placeholder="Tên huyện" autofocus/></td>
              </tr>
            </table>
            </form>      

          </div>
          <div class="modal-footer">
            <button type="submit"  class="btn btn-info btnluu">Lưu lại</button></td>
            <button type="button" class="btn btn-danger btnclose" style="float: right;" role="button">Đóng</button>
          </div>
          
        </div>
      </div>
    </div>

  <!-- Modal -->
    <div class="modal fade" id="danhsachxa" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="lineModalLabel">Danh sách xã</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">

            <!-- content goes here -->
            <input type="text" id=""  hidden="true">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên xã</th>
                      <th>Chỉnh sửa</th>
                    </tr>
                  </thead>   
                  <tbody id="dsxa">
                    <!-- Hiển thị danh sách các huyện -->

                  </tbody>
                </table>
                
          </div>
          <div class="modal-footer">
                <button type="button" class="btn btn-success" role="button" data-toggle="modal" data-target="#themxa" >Thêm xã</button>
                <button id="dsxaclose" type="button" class="btn btn-danger" style="float: right;" data-dismiss="modal" role="button">Đóng</button>
          </div>
          
        </div>
      </div>
    </div>
        <!-- Modal -->
    <div class="modal fade" id="themxa" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="lineModalLabel">Thêm Xã</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">

            <!-- content goes here -->
            <form id="formthemxa" action="{{ URL::to('admin/diadiem/themxa')}}" method="POST" enctype="multipart/form-data">
              <div id="ketquathemxa">
              </div>
              <input type="text" id="idtinhhuyenxa" name="idtinhhuyenxa"  hidden="true">
              <input type="text" id="tenhuyenxa" name="tenhuyenxa"  hidden="true">
              <table class="table table-striped table-hovered">
              <tr>
              
                <td>Tên xã</td>
                <td><input class="form-control" id="txa" name="tenxa"  placeholder="Tên xã" autofocus/></td>
              </tr>
            </table>
            </form>    

          </div>          
          <div class="modal-footer">
            <button type="submit"  class="btn btn-info btnluu">Lưu lại</button></td>
            <button type="button" class="btn btn-danger btnclose" style="float: right;" role="button">Đóng</button>
          </div>
          
        </div>
      </div>
    </div>
       <!-- Modal -->
    <div class="modal fade" id="suaxa" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="lineModalLabel">Chỉnh sửa Xã</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">

            <!-- content goes here -->
            <form id="formsuaxa" action="{{ URL::to('admin/diadiem/suaxa')}}" method="POST" enctype="multipart/form-data">
              <div id="ketquasuaxa">
              </div>
              <input type="text" id="idtinhhuyenxaedit" name="idtinhhuyenxaedit"  hidden="true">
              <input type="text" id="tenhuyenxaedit" name="tenhuyenxaedit"  hidden="true">
              <input type="text" id="tenxaold" name="tenxaold"  hidden="true">
              <table class="table table-striped table-hovered">
              <tr>              
                <td>Tên xã</td>
                <td><input class="form-control" id="txaedit" name="tenxaedit"  placeholder="Tên xã" autofocus/></td>
              </tr>
            </table>
            </form>      

          </div>
          <div class="modal-footer">
            <button type="submit"  class="btn btn-info btnluu">Lưu lại</button></td>
            <button type="button" class="btn btn-danger btnclose" style="float: right;" role="button">Đóng</button>
          </div>
          
        </div>
      </div>
    </div>

@endsection

@section('script')
var select_idtinh;
var select_huyen;
<script type="text/javascript">
$('.btnclose').click(function(){
    location.reload();
  });

function danhsachhuyen(e) {
  var url = "diadiem/ajaxgetdshuyen/"+e.value;
  select_idtinh = e.value;
  $.ajax({
    type : 'get',
    url : url,
    dataType : 'json',    
    success:function(data)
    {
      var ds = document.getElementById("dshuyen");
      ds.innerHTML = " ";
      if(data == "") ds.innerHTML += "<tr><td colspan=3>Tỉnh hiện tại chưa có huyện. Vui lòng cập nhật huyện!</td></tr>";
      else{
      $('#idtinh').val(e.value);
      for (var i = 0; i < data.length ; i++) {
        ds.innerHTML += "<tr><td>"+(i+1)+"</td><td id=tenhuyen"+i+">"+data[i]+"</td>"+
        "<td><button value='"+i+"' onclick='danhsachxa(this)' class='btn btn-primary a-btn-slide-text'>"+
          "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span><span>Danh sách xã </span></button></td>"+
          "<td><button value='"+i+"' onclick='suahuyen(this)' class='btn btn-primary a-btn-slide-text'>"+
          "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span><span>Chỉnh sửa </span></button></td>"+"<td><button value='"+i+"' onclick='xoahuyen(this)' class='btn btn-danger a-btn-slide-text'>"+
          "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span><span>Xóa </span></button></td></tr>";
      }
      
   }
      $('#danhsachhuyen').modal('show'); 
   }
 });
}
function danhsachxa(e) {
  var url = "diadiem/ajaxgetdsxa/"+$('#idtinh').val();
  var huyen= document.getElementById('tenhuyen'+e.value).innerHTML;
  select_huyen = huyen;

  $.ajax({
    type : 'get',
    url : url,
    data : {'tenhuyen' :huyen},
    dataType : 'json',    
    success:function(data)
    {
      var ds = document.getElementById("dsxa");
      ds.innerHTML = " ";
      if(data == "") ds.innerHTML += "<tr><td colspan=3>Huyện hiện tại chưa có xã. Vui lòng cập nhật xã!</td></tr>";
      else{      
      for (var i = 0; i < data.length ; i++) {
        ds.innerHTML += "<tr><td>"+(i+1)+"</td><td id=tenxa"+i+">"+data[i]+"</td>"+
        "<td><button value='"+i+"' onclick='suaxa(this)' class='btn btn-primary a-btn-slide-text'>"+
          "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span><span>Chỉnh sửa</span></button></td></tr>";
      }       
      }
      $('#danhsachxa').modal('show');      
    }
});
}
function xoahuyen(e) {
  var huyen= document.getElementById('tenhuyen'+e.value).innerHTML;
  if (confirm("Bạn có chắc chắn muốn xóa huyện "+ huyen) == true) {
    var data ={idtinh:select_idtinh, tenhuyen:huyen};
    $.ajax({
    type : 'post',
    url : "diadiem/xoahuyen",
    data : data,
    dataType : 'json',    
    success:function(responses)
    {
          console.log(responses);
      if($.isEmptyObject(responses.error))
      {
        alert(responses.success) ;
        location.reload();
      }
      else
      {
       alert(responses.error);
     }
   }
 });
  }
}
//Ajax thêm tỉnh
$('#formthemtinh').on('submit',function(e){
  e.preventDefault();
  var data = $(this).serialize();
  var url = $(this).attr('action');
  var post = $(this).attr('method');
  $.ajax({
    type : post,
    url : url,
    data : data,
    dataType : 'json',    
    success:function(responses)
    {
      var $this = $('#ketquathemtinh');
      if($.isEmptyObject(responses.error))
      {
        var messageHtml = '<div class="alert alert-success">';
        messageHtml += responses.success;
        messageHtml += '</div>';
        document.getElementById('ttinh').value= ' ';
        $( '#ketquathemtinh' ).html( messageHtml);
      }
      else
      {
       printErrorthemtinh(responses.error);
     }
   }
 });

}); 

function printErrorthemtinh (responses)
{
  var messageHtml = '<div class="alert alert-danger"><ul>';
  for (var key in responses) 
  {
    if (responses.hasOwnProperty(key)) 
    {
      var val = responses[key];
      messageHtml += '<li>' + val + '</li>'; 
    }
  }
  messageHtml += '</ul></div>';
  $( '#ketquathemtinh' ).html( messageHtml );
}
//Ajax sửa tỉnh
function suatinh(e) {
  var tinh= document.getElementById('tentinh'+e.value).innerHTML;
  $('#suatinh').modal('show'); 
  $('#ttinhedit').val(tinh);
  $('#idtinhedit').val(e.value);

}
$('#formsuatinh').on('submit',function(e){
  e.preventDefault();
  var data = $(this).serialize();
  var url = $(this).attr('action')+"/"+$('#idtinhedit').val();
  var post = $(this).attr('method');
  $.ajax({
    type : post,
    url : url,
    data : data,
    dataType : 'json',    
    success:function(responses)
    {
      var $this = $('#ketquasuatinh');
      if($.isEmptyObject(responses.error))
      {
        var messageHtml = '<div class="alert alert-success">';
        messageHtml += responses.success;
        messageHtml += '</div>';
        $( '#ketquasuatinh' ).html( messageHtml);
      }
      else
      {
       printErrorsuatinh(responses.error);
     }
   }
 });

}); 

function printErrorsuatinh (responses)
{
  var messageHtml = '<div class="alert alert-danger"><ul>';
  for (var key in responses) 
  {
    if (responses.hasOwnProperty(key)) 
    {
      var val = responses[key];
      messageHtml += '<li>' + val + '</li>'; 
    }
  }
  messageHtml += '</ul></div>';
  $( '#ketquasuatinh' ).html( messageHtml );
}
// Ajax thêm huyện
$('#formthemhuyen').on('submit',function(e){
  e.preventDefault();
  $('#idtinhhuyen').val(select_idtinh);
  var data = $(this).serialize();
  var url = $(this).attr('action');
  var post = $(this).attr('method');
  $.ajax({
    type : post,
    url : url,
    data : data,
    dataType : 'json',    
    success:function(responses)
    {
      var $this = $('#ketquathemhuyen');
      if($.isEmptyObject(responses.error))
      {
        var messageHtml = '<div class="alert alert-success">';
        messageHtml += responses.success;
        messageHtml += '</div>';
        document.getElementById('thuyen').value= ' ';
        $( '#ketquathemhuyen' ).html( messageHtml);
      }
      else
      {
       printErrorthemhuyen(responses.error);
     }
   }
 });

}); 

function printErrorthemhuyen (responses)
{
  var messageHtml = '<div class="alert alert-danger"><ul>';
  for (var key in responses) 
  {
    if (responses.hasOwnProperty(key)) 
    {
      var val = responses[key];
      messageHtml += '<li>' + val + '</li>'; 
    }
  }
  messageHtml += '</ul></div>';
  $( '#ketquathemhuyen' ).html( messageHtml );
}
//Ajax sửa huyện
function suahuyen(e) {
  var huyen= document.getElementById('tenhuyen'+e.value).innerHTML;
  $('#suahuyen').modal('show'); 
  $('#thuyenedit').val(huyen);
  $('#tenhuyenold').val(huyen);
  $('#idtinhhuyenedit').val(select_idtinh);

}
$('#formsuahuyen').on('submit',function(e){
  e.preventDefault();
  var data = $(this).serialize();
  var url = $(this).attr('action');
  var post = $(this).attr('method');
  $.ajax({
    type : post,
    url : url,
    data : data,
    dataType : 'json',    
    success:function(responses)
    {
      var $this = $('#ketquasuahuyen');
      if($.isEmptyObject(responses.error))
      {
        var messageHtml = '<div class="alert alert-success">';
        messageHtml += responses.success;
        messageHtml += '</div>';
        $( '#ketquasuahuyen' ).html( messageHtml);
      }
      else
      {
       printErrorsuahuyen(responses.error);
     }
   }
 });

}); 

function printErrorsuahuyen (responses)
{
  var messageHtml = '<div class="alert alert-danger"><ul>';
  for (var key in responses) 
  {
    if (responses.hasOwnProperty(key)) 
    {
      var val = responses[key];
      messageHtml += '<li>' + val + '</li>'; 
    }
  }
  messageHtml += '</ul></div>';
  $( '#ketquasuahuyen' ).html( messageHtml );
}
// Ajax thêm xã
$('#formthemxa').on('submit',function(e){
  e.preventDefault();
  $('#idtinhhuyenxa').val(select_idtinh);
  $('#tenhuyenxa').val(select_huyen);
  var data = $(this).serialize();
  var url = $(this).attr('action');
  var post = $(this).attr('method');
  $.ajax({
    type : post,
    url : url,
    data : data,
    dataType : 'json',    
    success:function(responses)
    {
      var $this = $('#ketquathemhuyen');
      if($.isEmptyObject(responses.error))
      {
        var messageHtml = '<div class="alert alert-success">';
        messageHtml += responses.success;
        messageHtml += '</div>';
        document.getElementById('txa').value= ' ';
        $( '#ketquathemxa' ).html( messageHtml);
      }
      else
      {
       printErrorthemxa(responses.error);
     }
   }
 });

}); 

function printErrorthemxa (responses)
{
  var messageHtml = '<div class="alert alert-danger"><ul>';
  for (var key in responses) 
  {
    if (responses.hasOwnProperty(key)) 
    {
      var val = responses[key];
      messageHtml += '<li>' + val + '</li>'; 
    }
  }
  messageHtml += '</ul></div>';
  $( '#ketquathemxa' ).html( messageHtml );
}
//Ajax sửa xã
function suaxa(e) {
  var xa= document.getElementById('tenxa'+e.value).innerHTML;
  $('#suaxa').modal('show'); 
  $('#txaedit').val(xa);
  $('#tenxaold').val(xa);
  $('#tenhuyenxaedit').val(select_huyen);
  $('#idtinhhuyenxaedit').val(select_idtinh);

}
$('#formsuaxa').on('submit',function(e){
  e.preventDefault();
  var data = $(this).serialize();
  var url = $(this).attr('action');
  var post = $(this).attr('method');
  $.ajax({
    type : post,
    url : url,
    data : data,
    dataType : 'json',    
    success:function(responses)
    {
      var $this = $('#ketquasuaxa');
      if($.isEmptyObject(responses.error))
      {
        var messageHtml = '<div class="alert alert-success">';
        messageHtml += responses.success;
        messageHtml += '</div>';
        $( '#ketquasuaxa' ).html( messageHtml);
      }
      else
      {
       printErrorsuaxa(responses.error);
     }
   }
 });

}); 

function printErrorsuaxa (responses)
{
  var messageHtml = '<div class="alert alert-danger"><ul>';
  for (var key in responses) 
  {
    if (responses.hasOwnProperty(key)) 
    {
      var val = responses[key];
      messageHtml += '<li>' + val + '</li>'; 
    }
  }
  messageHtml += '</ul></div>';
  $( '#ketquasuaxa' ).html( messageHtml );
}
</script>
@endsection