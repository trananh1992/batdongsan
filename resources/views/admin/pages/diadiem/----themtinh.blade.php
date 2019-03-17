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
<form method="POST" action="{{ asset('/themtinh') }}" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label>Tên tỉnh</label>
    <input type="text" class="form-control" name="tentinh">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>




@endsection

@section('script')

@endsection