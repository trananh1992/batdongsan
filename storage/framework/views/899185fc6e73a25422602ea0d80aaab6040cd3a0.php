<?php /* D:\xampp\htdocs\batdongsan\resources\views/admin/pages/tintuc/add.blade.php */ ?>
<?php $__env->startSection('contentadmin'); ?>
<?php if(\Session::has('success')): ?>
      <div class="alert alert-success">
        <p><?php echo e(\Session::get('success')); ?></p>
      </div><br />
     <?php endif; ?>
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li><?php echo e($error); ?></li>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<a href="<?php echo e(asset('/tintuc')); ?>"><button type="button" class="btn btn-secondary">&laquo; Quay lại</button></a>
<p>
<form method="POST" action="<?php echo e(asset('/tintucadd')); ?>" enctype="multipart/form-data">
<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
  <div class="form-group">
    <label>Tiêu đề</label>
    <input type="text" class="form-control" name="tieude">
  </div>
  <div class="form-group">
    <label>Nội dung</label>
    <textarea class="form-control" rows="5" id="noidung" name="noidung"></textarea>
  </div>
  <div class="form-group">
    <label>Giá</label>
    <input type="text" class="form-control" name="gia">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script> CKEDITOR.replace('noidung'); </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>