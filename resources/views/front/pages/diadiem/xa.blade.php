  @extends('admin.layouts.index')

  @section('contentadmin')

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h4 class="m-0 font-weight-bold text-primary">Danh sách các xã</h4>
      <button style="float: right;" data-toggle="modal" data-target="#themxa" class="btn btn-primary btn-md">Thêm xã</button> 
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên xã</th>
              <th>Sửa tên xã</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1; ?>
            @foreach($huyen->dsxa as $x)
            <tr>
              <td>{{$i++}}</td>
              <td id="tenxa{{$x->id}}">{{$x->ten}}</td>
            </td>
            <td><button id="suaxa{{$x->id}}"  value="{{$x->id}}" onclick="suaxa(this)" class="btn btn-primary a-btn-slide-text">
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
<div class="modal fade" id="suaxa" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="lineModalLabel">Chỉnh sửa Xã</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id="formsuaxa" action="{{ URL::to('admin/diadiem/suaxa')}}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <!-- content goes here --> 
          <div id="ketquasuaxa">
          </div>
          <input type="text" id="idtinh" name="idtinh" value="{{$idtinh}}"  hidden="true">
          <input type="text" id="idhuyen" name="idhuyen" value="{{$idhuyen}}" hidden="true">
          <input type="text" id="idxa" name="idxa"  hidden="true">
          <table class="table table-striped table-hovered">
            <tr>              
              <td>Tên xã</td>
              <td><input class="form-control" id="tenxa" name="tenxa"  placeholder="Tên xã" autofocus/></td>
            </tr>
          </table>    

        </div>
        <div class="modal-footer">
          <button type="submit"  class="btn btn-info btnluu">Lưu lại</button></td>
          <button type="button" class="btn btn-danger btnclose" style="float: right;" role="button">Đóng</button>
        </div>
      </form>  
      
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
      <!-- content goes here -->
      <form id="formthemxa" action="{{ URL::to('admin/diadiem/themxa')}}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div id="ketquathemxa">
          </div>
          <input type="text" id="idtinh" name="idtinh" value="{{$idtinh}}"  hidden="true">
          <input type="text" id="idhuyen" name="idhuyen" value="{{$idhuyen}}" hidden="true">
          <table class="table table-striped table-hovered">
            <tr>              
              <td>Tên xã</td>
              <td><input class="form-control" id="tenxa" name="tenxa"  placeholder="Tên xã" autofocus/></td>
            </tr>
          </table> 
        </div>          
        <div class="modal-footer">
          <button type="submit"  class="btn btn-info btnluu">Lưu lại</button></td>
          <button type="button" class="btn btn-danger btnclose" style="float: right;" role="button">Đóng</button>
        </div>
      </form>   
      
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
  $('.btnclose').click(function(){
    location.reload();
  });
  // Ajax thêm xã
  $('#formthemxa').on('submit',function(e){
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
        if($.isEmptyObject(responses.error))
        {
          var messageHtml = '<div class="alert alert-success">';
          messageHtml += responses.success;
          messageHtml += '</div>';  
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
    $('#tenxa').val(xa);
    $('#idxa').val(e.value);

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
      { console.log(responses);
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