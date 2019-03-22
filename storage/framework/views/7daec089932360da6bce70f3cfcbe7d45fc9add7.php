<?php /* D:\xampp\htdocs\batdongsan\resources\views/admin/pages/danhmuc/huong.blade.php */ ?>
<?php $__env->startSection('contentadmin'); ?>

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
 -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Danh Mục Hướng</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Hướng</th>
                      <th>Chỉnh sửa</th>
                      <th>Xóa</th>
                
                    </tr>
                  </thead>
                  <?php $i=1; ?>
                  	<?php $__currentLoopData = $dshuong; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($i++); ?></td>
                      <td id="tenhuong<?php echo e($h->_id); ?>"><?php echo $h->tenhuong; ?></td>
                     
                      <td><button class="btn btn-primary a-btn-slide-text" data-toggle="modal" data-target="#suahuong" value="<?php echo e($h->_id); ?>" onclick="suahuong(this)">
                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          <span><strong>Chỉnh sửa</strong></span>            
                      </button>
                      </td>
                        <td><button id="xoahuong<?php echo e($h->id); ?>"  value="<?php echo e($h->id); ?>" onclick="xoahuong(this)" class="btn btn-danger a-btn-slide-text">
                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          <span><strong>Xóa hướng</strong></span>           
                      </a>
                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#themhuong">Thêm Hướng Mới</button>

 <!-- Modal Sửa hướng-->
<div class="modal fade" id="suahuong" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="lineModalLabel">Chỉnh sửa hướng</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <!-- content goes here -->
        <form id="formsuahuong" action="<?php echo e(URL::to('admin/danhmuc/suahuong')); ?>" method="POST" enctype="multipart/form-data">
          <div id="ketquasuahuong" >
          </div>
          <input class="form-control" id="idhuong" name="idhuong"  hidden="true" />
          <table class="table table-striped table-hovered">
            <tr>

              <td>Tên hướng</td>
              <td><input class="form-control" id="tenhuong" name="tenhuong"  placeholder="Tên hướng" autofocus/></td>
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
<div class="modal fade" id="themhuong" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="lineModalLabel">Thêm hướng</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <!-- content goes here -->
        <form id="formthemhuong" action="<?php echo e(URL::to('admin/danhmuc/themhuong')); ?>" method="POST" enctype="multipart/form-data">
          <div id="ketquathemhuong" >
          </div>
          <table class="table table-striped table-hovered">
            <tr>

              <td>Tên hướng</td>
              <td><input class="form-control" id="thuong" name="tenhuong"  placeholder="Tên hướng" autofocus/></td>
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

function xoahuong(e){
    var huong= document.getElementById('tenhuong'+e.value).innerHTML;
    if(confirm("Bạn chắc chắn muốn xóa hướng: "+huong + " không ?") == true){
      var url = base_url+'/admin/danhmuc/xoahuong/'+e.value;
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



function suahuong(e){
  var tenhuong = document.getElementById('tenhuong'+e.value).innerHTML;
  $('#tenhuong').val(tenhuong);
  $('#idhuong').val(e.value);
}
//Ajax sua hướng
  $('#formsuahuong').on('submit',function(e){
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
        var $this = $('#ketquasuahuong');
        if($.isEmptyObject(responses.error))
        {
          var messageHtml = '<div class="alert alert-success">';
          messageHtml += responses.success;
          messageHtml += '</div>';
          $( '#ketquasuahuong' ).html( messageHtml);
        }
        else
        {
         printErrorsuahuong(responses.error);
       }
     }
   });

  }); 

  function printErrorsuahuong (responses)
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
    $( '#ketquasuahuong' ).html( messageHtml );
  }


  //Ajax thêm hướng
  $('#formthemhuong').on('submit',function(e){
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
        var $this = $('#ketquathemhuong');
        if($.isEmptyObject(responses.error))
        {
          var messageHtml = '<div class="alert alert-success">';
          messageHtml += responses.success;
          messageHtml += '</div>';
          document.getElementById('thuong').value= ' ';
          $( '#ketquathemhuong' ).html( messageHtml);
        }
        else
        {
         printErrorthemhuong(responses.error);
       }
     }
   });

  }); 

  function printErrorthemhuong (responses)
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
    $( '#ketquathemhuong' ).html( messageHtml );
  }

  
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>