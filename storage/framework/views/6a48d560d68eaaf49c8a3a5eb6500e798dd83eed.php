<?php /* D:\xampp\htdocs\batdongsan\resources\views/admin/pages/diadiem/tinh.blade.php */ ?>
  

  <?php $__env->startSection('contentadmin'); ?>

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
              <th>Xóa tỉnh</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1; ?>
            <?php $__currentLoopData = $tinh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($i++); ?></td>
              <td id="tentinh<?php echo e($t->id); ?>"><?php echo e($t->ten); ?></td>
              <td><a href="<?php echo e(URL::to('admin/diadiem/huyen')); ?>/<?php echo e($t->id); ?>" target="_blank">
                <button  class="btn btn-primary a-btn-slide-text">
                  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                  <span>Danh sách</span>            
                </button></a>
              </td>
              <td><button id="suatinh<?php echo e($t->id); ?>"  value="<?php echo e($t->id); ?>" onclick="suatinh(this)" class="btn btn-primary a-btn-slide-text">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Chỉnh sửa</strong></span>            
              </button>
            </td>
            <td><button id="xoatinh<?php echo e($t->id); ?>"  value="<?php echo e($t->id); ?>" onclick="xoatinh(this)" class="btn btn-danger a-btn-slide-text">
              <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
              <span>Xóa</span>            
            </button>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <form id="formsuatinh" action="<?php echo e(URL::to('admin/diadiem/suatinh')); ?>" method="POST" enctype="multipart/form-data">
          <div id="ketquasuatinh" >
          </div>
          <input  id="idtinh" name="idtinh" hidden="true">
          <table class="table table-striped table-hovered">
            <tr>              
              <td>Tên tỉnh</td>
              <td><input class="form-control" id="tentinh" name="tentinh"  placeholder="Tên tỉnh" autofocus/></td>
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
        <form id="formthemtinh" action="<?php echo e(URL::to('admin/diadiem/themtinh')); ?>" method="POST" enctype="multipart/form-data">
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
var select_idtinh;
var select_huyen;
<script type="text/javascript">
  $('.btnclose').click(function(){
    location.reload();
  });

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
    $('#tentinh').val(tinh);
    $('#idtinh').val(e.value);

  }
  $('#formsuatinh').on('submit',function(e){
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
  
  function xoatinh(e){
    var tinh= document.getElementById('tentinh'+e.value).innerHTML;
    if(confirm("Bạn chắc chắn muốn xóa tỉnh: "+tinh) == true){
      var url = base_url+'/admin/diadiem/xoatinh/'+e.value;
      $.ajax({
        type : 'get',
        url : url,
        // data : data,
        dataType : 'json',    
        success:function(responses)
        {
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>