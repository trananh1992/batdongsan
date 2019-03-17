@extends('admin.layouts.index')
@section('contentadmin')
@if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
@foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
  @endforeach
<a href="{{ asset('/tintuc') }}"><button type="button" class="btn btn-secondary">&laquo; Quay lại</button></a>
<p>
<form method="POST" action="{{ asset('/tintucadd') }}" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
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

@endsection

@section('script')
<script> CKEDITOR.replace('noidung'); </script>
@endsection