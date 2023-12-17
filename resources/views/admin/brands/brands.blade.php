@extends('admin_layout.admin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sections</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sections</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Brands</h3>
                <a href="{{ route('admin.add_edit_brands') }}" style="float:right; display:block-inline" class="btn btn-primary"> Add New Brand</a>                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                              @if(Session::has("success_msg"))
                <div class="alert-success py-4 px-4 font-medium">{{ Session::get("success_msg")}}</div>
              @endif        
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($brands as $brand)  
                  <tr>
                      <td>{{$brand->id}}</td>
                      <td>{{$brand->name}}</td>
                      <td>@if($brand->status == 1) 
                          <a href="javascript:void(0)" class="update-brand-status" id="brand-{{$brand->id}}" brandid="{{$brand->id}}"><i class="fa fa-toggle-on" status="Active" aria-hidden="true"></i></a> 
                          @else 
                          <a href="javascript:void(0)" class="update-brand-status" id="brand-{{$brand->id}}" brandid="{{$brand->id}}"><i class="fa fa-toggle-off" status="Inactive" aria-hidden="true"></i></a>                           
                          @endif
                          <a href="{{ route('admin.add_edit_brands',$brand->id) }}" alt="Edit brand"><i class="far fa-edit"></i></a>
                        &nbsp;&nbsp;
                        <a class="confirmDelete" record="brand" recordid="{{$brand->id}}" alt="Delete brand" name="brand" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a>
                                              
                        </td>
                  </tr>
                  @endforeach
                  </tbody>                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection