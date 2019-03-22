@extends('admin.layouts.index')

@section('contentadmin')

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
 -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Danh Mục Bất Động Sản</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên loại Bất Động Sản</th>
                      <th>Chỉnh sửa</th>
                      <th>Xóa</th>
                
                    </tr>
                  </thead>
                  <?php $i=1; ?>
                    @foreach($dsdanhmuc as $item)
                    <tr>
                      <td>{{$i++}}</td>
                      <td id="ten{{$item->_id}}">{!! $item->tenloaibds !!}</td>
                     
                      <td><button class="btn btn-primary a-btn-slide-text" data-toggle="modal" data-target="#sua" value="{{$item->_id}}" onclick="sua(this)">
                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          <span><strong>Chỉnh sửa</strong></span>            
                      </button>
                      </td>
                        <td><button id="xoaloaibds{{$item->id}}"  value="{{$item->id}}" onclick="xoa(this)" class="btn btn-danger a-btn-slide-text">
                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          <span><strong>Xóa</strong></span>           
                      </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#them">Thêm Mới</button>

 <!-- Modal Sửa-->
<div class="modal fade" id="sua" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="lineModalLabel">Chỉnh sửa loại Bất Động Sản</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <!-- content goes here -->
        <form id="formsua" action="{{ URL::to('admin/danhmuc/sualoaibds')}}" method="POST" enctype="multipart/form-data">
          <div id="ketquasua" >
          </div>
          <input class="form-control" id="iddanhmuc" name="iddanhmuc"  hidden="true" />
          <table class="table table-striped table-hovered">
            <tr>

              <td>Tên loại bất động sản</td>
              <td><input class="form-control" id="tendanhmuc" name="tendanhmuc"  placeholder="Tên loại bất động sản" autofocus/></td>
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
<div class="modal fade" id="them" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="lineModalLabel">Thêm hướng</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <!-- content goes here -->
        <form id="formthem" action="{{ URL::to('admin/danhmuc/themloaibds')}}" method="POST" enctype="multipart/form-data">
          <div id="ketquathem" >
          </div>
          <table class="table table-striped table-hovered">
            <tr>

              <td>Tên loại bất động sản</td>
              <td><input class="form-control" id="txt_ten" name="ten"  placeholder="Tên loại bất động sản" autofocus/></td>
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

@endsection

@section('script')
var select_idtinh;
var select_huyen;
<script type="text/javascript">
  $('.btnclose').click(function(){
    location.reload();
  });

function xoa(e){
    var tendanhmuc= document.getElementById('ten'+e.value).innerHTML;
    if(confirm("Bạn chắc chắn muốn xóa loại bất động sản: "+tendanhmuc + " không ?") == true){
      var url = base_url+'/admin/danhmuc/xoaloaibds/'+e.value;
      $.ajax({
        type : 'get',
        url : url,
        // data : data,
        dataType : 'json',    
        success:function(responses)
        {
          console.log(responses);
          if($.isEmptyObject(responses.error)){
            alert(responses.success);
            location.reload();
          }else{
            alert('Lỗi! Không thể xóa');
          }
          
        }
      });
    }
  }



function sua(e){
  var tendanhmuc = document.getElementById('ten'+e.value).innerHTML;
  $('#tendanhmuc').val(tendanhmuc);
  $('#iddanhmuc').val(e.value);
}
//Ajax sua hướng
  $('#formsua').on('submit',function(e){
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
        console.log(responses);
        var $this = $('#ketquasua');
        if($.isEmptyObject(responses.error))
        {
          var messageHtml = '<div class="alert alert-success">';
          messageHtml += responses.success;
          messageHtml += '</div>';
          $( '#ketquasua' ).html( messageHtml);
        }
        else
        {
         printErrorsua(responses.error);
       }
     }
   });

  }); 

  function printErrorsua (responses)
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
    $( '#ketquasua' ).html( messageHtml );
  }


  //Ajax thêm hướng
  $('#formthem').on('submit',function(e){
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
        console.log(responses);
        var $this = $('#ketquathem');
        if($.isEmptyObject(responses.error))
        {
          var messageHtml = '<div class="alert alert-success">';
          messageHtml += responses.success;
          messageHtml += '</div>';
          document.getElementById('txt_ten').value= '';
          $( '#ketquathem' ).html( messageHtml);
        }
        else
        {
         printErrorthem(responses.error);
       }
     }
   });

  }); 

  function printErrorthem (responses)
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
    $( '#ketquathem' ).html( messageHtml );
  }

  
</script>
@endsection