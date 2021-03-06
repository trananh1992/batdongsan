<?php /* D:\xampp\htdocs\batdongsan\resources\views/admin/pages/diadiem/huyen.blade.php */ ?>
<?php $__env->startSection('contentadmin'); ?>

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
 -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary">Danh sách các huyện</h4>
              <button style="float: right;" data-toggle="modal" data-target="#themhuyen" class="btn btn-primary btn-md">Thêm huyện mới</button> 
            </div>
            <div class="card-body">
              <div class="table-responsive">
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
                  <tbody>
                  <?php $i=1; ?>
                  	<?php $__currentLoopData = $tinh->dshuyen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($i++); ?></td>
                      <td id="tenhuyen<?php echo e($h->id); ?>"><?php echo e($h->ten); ?></td>
                      <td><a href="<?php echo e(URL::to('admin/diadiem/xa')); ?>/<?php echo e($tinh->id); ?>/<?php echo e($h->id); ?>" target="_blank"><button class="btn btn-primary a-btn-slide-text">
                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          <span>Danh sách</span>            
                      </button></a>
                      </td>
                      <td><button id="suahuyen<?php echo e($h->id); ?>"  value="<?php echo e($h->id); ?>" onclick="suahuyen(this)" class="btn btn-primary a-btn-slide-text">
                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          <span><strong>Chỉnh sửa</strong></span>            
                      </button>
                      </td>
                      <td><button id="xoahuyen<?php echo e($h->id); ?>"  value="<?php echo e($h->id); ?>" onclick="xoahuyen(this)" class="btn btn-danger a-btn-slide-text">
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
    <div class="modal fade" id="suahuyen" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="lineModalLabel">Chỉnh sửa huyện</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" >
            <form id="formsuahuyen" action="<?php echo e(URL::to('admin/diadiem/suahuyen')); ?>" method="POST" enctype="multipart/form-data">
              <div id="ketquasuahuyen" >
              </div>
              <input id="idhuyen" name="idhuyen" hidden="true">
              <input type="text" id="idtinh" name="idtinh" value="<?php echo e($tinh->id); ?>" hidden="true">
              <table class="table table-striped table-hovered">
              <tr>
              
                <td>Tên huyện</td>
                <td><input class="form-control" id="tenhuyen" name="tenhuyen"  placeholder="Tên huyện" autofocus/></td>
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
    <div class="modal fade" id="themhuyen" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="lineModalLabel">Thêm huyện</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">

            <!-- content goes here -->
            <form id="formthemhuyen" action="<?php echo e(URL::to('admin/diadiem/themhuyen')); ?>" method="POST" enctype="multipart/form-data">
              <div id="ketquathemhuyen" >
              </div>
              <input type="text" id="idtinh" name="idtinh" value="<?php echo e($tinh->id); ?>" hidden="true">
              <table class="table table-striped table-hovered">
              <tr>
              
                <td>Tên tỉnh</td>
                <td><input class="form-control" id="thuyen" name="tenhuyen"  placeholder="Tên huyện" autofocus/></td>
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
<script type="text/javascript">
$('.btnclose').click(function(){
    location.reload();
  });
 var tinh = $('#idtinh').val();
// Ajax thêm huyện
$('#formthemhuyen').on('submit',function(e){
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
  $('#tenhuyen').val(huyen);
  $('#idhuyen').val(e.value);

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
    { console.log(responses);
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
function xoahuyen(e){
    var huyen= document.getElementById('tenhuyen'+e.value).innerHTML;
    if(confirm("Bạn chắc chắn muốn xóa huyện: "+huyen) == true){
      var url = base_url+'admin/diadiem/xoahuyen/'+tinh+'/'+e.value;
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