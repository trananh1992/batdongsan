@extends('admin.layouts.index')

@section('contentadmin')

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
 -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Danh Mục Hướng Bất Động Sản</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Hướng</th>
                
                    </tr>
                  </thead>
                  <?php $i=1; ?>
                  	@foreach($huong as $h)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{!! $h->ten !!}</td>
                     
                      <td><a href="tintucedit/{{$t->id}}" class="btn btn-primary a-btn-slide-text">
                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          <span><strong>Edit</strong></span>            
                      </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalAddHuong">Thêm Hướng Mới</button>

 <!-- Modal -->
  <div class="modal fade" id="ModalAddHuong" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="lineModalLabel">Thêm Hướng</h3>
          </div>
          <div class="modal-body">

            <!-- content goes here -->
            <form id="form_insert" action="{{ URL::to('addhuong')}}" method="POST" enctype="multipart/form-data">
              <div id="ketqua" >
              </div>
              <table class="table table-striped table-hovered">
              <tr>
              
                <td>Tên Hướng</td>
                <td><input class="form-control" name="tenhuong"  placeholder="Tên Hướng"/></td>
              </tr>
              <tr>
                <td align="right"><button type="submit" class="btn btn-info">Lưu lại</button></td>
                <td> <button type="button" id="btnClose" class="btn btn-success" data-action="close" data-dismiss="modal" role="button">Đóng</button></td>
              </tr>
            </table>
            </form>      

          </div>
          
        </div>
      </div>
    </div>

@endsection