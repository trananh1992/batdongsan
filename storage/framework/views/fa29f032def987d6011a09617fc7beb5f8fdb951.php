<?php /* D:\xampp\htdocs\batdongsan\resources\views/admin/pages/diadiem/xa.blade.php */ ?>
  

  <?php $__env->startSection('contentadmin'); ?>

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
              <th>Xóa xã</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1; ?>
            <?php $__currentLoopData = $huyen->dsxa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($i++); ?></td>
              <td id="tenxa<?php echo e($x->id); ?>"><?php echo e($x->ten); ?></td>
            </td>
            <td><button id="suaxa<?php echo e($x->id); ?>"  value="<?php echo e($x->id); ?>" onclick="suaxa(this)" class="btn btn-primary a-btn-slide-text">
              <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
              <span><strong>Chỉnh sửa</strong></span>            
            </button>
          </td>
          <td>
            <button id="xoaxa<?php echo e($x->id); ?>"  value="<?php echo e($x->id); ?>" onclick="xoaxa(this)" class="btn btn-danger a-btn-slide-text">
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
<div class="modal fade" id="suaxa" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="lineModalLabel">Chỉnh sửa Xã</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id="formsuaxa" action="<?php echo e(URL::to('admin/diadiem/suaxa')); ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <!-- content goes here --> 
          <div id="ketquasuaxa">
          </div>
          <input type="text" id="idtinh" name="idtinh" value="<?php echo e($idtinh); ?>"  hidden="true">
          <input type="text" id="idhuyen" name="idhuyen" value="<?php echo e($idhuyen); ?>" hidden="true">
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
      <form id="formthemxa" action="<?php echo e(URL::to('admin/diadiem/themxa')); ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div id="ketquathemxa">
          </div>
          <input type="text" id="idtinh" name="idtinh" value="<?php echo e($idtinh); ?>"  hidden="true">
          <input type="text" id="idhuyen" name="idhuyen" value="<?php echo e($idhuyen); ?>" hidden="true">
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  $('.btnclose').click(function(){
    location.reload();
  });
  var tinh = $('#idtinh').val();
  var huyen = $('#idhuyen').val();
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

  function xoaxa(e){
    var xa= document.getElementById('tenxa'+e.value).innerHTML;
    if(confirm("Bạn chắc chắn muốn xóa xã: "+xa) == true){
      var url = base_url+'admin/diadiem/xoaxa/'+tinh+'/'+huyen+'/'+e.value;
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