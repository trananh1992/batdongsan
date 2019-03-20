<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
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
      
      @foreach($nd as $n)
      <tr>
        <td>{{$n->id}}</td>
        <td>{{$n->ten}}</td>
        <td>{{$n->diachi}}</td>
        <td>{{$n->dientich}}</td>
        <td><a href="{{action('NhadatController@edit', $n->id)}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('NhadatController@destroy', $n->id)}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger"  onclick='return confirm("Bạn muốn xóa?");'>Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <a href="{{url('add')}}"><button type="button" class="btn btn-success">Thêm</button></a>
  </div>
  </body>
</html>