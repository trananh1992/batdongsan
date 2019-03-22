<?php /* D:\xampp\htdocs\batdongsan\resources\views/admin/pages/tintuc/danhsach.blade.php */ ?>
<?php $__env->startSection('contentadmin'); ?>

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
 -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Danh sách tin tức</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tiêu đề</th>
                      <th>Nội dung</th>
                      <th>Ngày tạo</th>
                      <th>Duyệt tin</th>
                      <th>Chỉnh sửa</th>
                    </tr>
                  </thead>
                  <?php $i=1; ?>
                  	<?php $__currentLoopData = $tintuc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($i++); ?></td>
                      <td><?php echo substr($t->tieude,0,100); ?></td>
                      <td><?php echo substr($t->noidung,0,100); ?>......</td>
                      <td><?php echo e($t->created_at); ?></td>
                      <td id="duyet<?php echo e($t->id); ?>"><?php if(isset($t->duyettin) && $t->duyettin ==1): ?>
                        <button class="btn btn-success a-btn-slide-text" value="<?php echo e($t->id); ?>" duyet="1" onclick="duyettin(this)">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span><strong>Đã duyệt</strong></span></button> 
                          <?php else: ?>
                          <button class="btn btn-secondary a-btn-slide-text" value="<?php echo e($t->id); ?>" duyet="0" onclick="duyettin(this)">
                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          <span><strong>Chưa duyệt</strong></span></button> 
                          <?php endif; ?>
                      </td>
                      <td><a href="tintuc/sua/<?php echo e($t->id); ?>" class="btn btn-primary a-btn-slide-text">
                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          <span><strong>Chỉnh sửa</strong></span></a>
                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        <a href="tintuc/them" /><button type="button" class="btn btn-success">Thêm mới</button></a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  
function duyettin(e) {
  var duyet = $(e).attr('duyet');
  var url = base_url+'/admin/tintuc/duyettin/'+e.value;
   $.ajax({
      type : 'get',
      url : url,
      // data : data,
      dataType : 'json',    
      success:function(responses)
      {
        if($.isEmptyObject(responses.error))
        {
          document.getElementById('duyet'+e.value).innerHTML = '';
          if(duyet == 1 && confirm("Bạn muốn đổi trạng thái tin thành chưa duyệt phải không?") == true){
          document.getElementById('duyet'+e.value).innerHTML += "<button class='btn btn-secondary a-btn-slide-text' value='"+e.value+"' duyet='0' onclick='duyettin(this)'>"+
            "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>"+
            "<span><strong>Chưa duyệt</strong></span></button>";
          }
          else{            
          document.getElementById('duyet'+e.value).innerHTML += "<button class='btn btn-success a-btn-slide-text' value='"+e.value+"' duyet='1' onclick='duyettin(this)'>"+
            "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>"+
            "<span><strong>Đã duyệt</strong></span></button>";
          }
        }
     }
   });
}

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>