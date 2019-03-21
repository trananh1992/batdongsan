<?php /* D:\xampp\htdocs\batdongsan\resources\views/admin/test.blade.php */ ?>
<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="<?php echo e(asset('/saveimage')); ?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
  Hình ảnh:<br>
  <input type="file" name="hinhanh" >
  <br><br>
  <input type="submit" value="Submit">
</form> 


</body>
</html>