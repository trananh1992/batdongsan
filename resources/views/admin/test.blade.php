<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="{{ asset('/saveimage')}}" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
  Hình ảnh:<br>
  <input type="file" name="hinhanh" >
  <br><br>
  <input type="submit" value="Submit">
</form> 


</body>
</html>