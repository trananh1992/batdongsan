<?php /* D:\xampp\htdocs\batdongsan\resources\views/nhadatindex.blade.php */ ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
  </head>
  <body>
    <div class="container">
    <br />
    <?php if(\Session::has('success')): ?>
      <div class="alert alert-success">
        <p><?php echo e(\Session::get('success')); ?></p>
      </div><br />
     <?php endif; ?>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>OID</th>
        <th>Tên nhà đất</th>
        <th>Địa chỉ</th>
        <th>Diện tích</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      
      <?php $__currentLoopData = $nd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($n->id); ?></td>
        <td><?php echo e($n->ten); ?></td>
        <td><?php echo e($n->diachi); ?></td>
        <td><?php echo e($n->dientich); ?></td>
        <td><a href="<?php echo e(action('NhadatController@edit', $n->id)); ?>" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="<?php echo e(action('NhadatController@destroy', $n->id)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger"  onclick='return confirm("Bạn muốn xóa?");'>Delete</button>
          </form>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
  <a href="<?php echo e(url('add')); ?>"><button type="button" class="btn btn-success">Thêm</button></a>
  </div>
  </body>
</html>