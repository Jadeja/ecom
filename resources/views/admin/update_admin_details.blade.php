@extends('admin_layout.admin_layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Admin Details</h3>
              </div>
              <!-- /.card-header -->
              @if(Session::has("error_msg"))
                <div class="alert-danger py-4 px-4 font-medium">{{ Session::get("error_msg")}}</div>
              @endif
              @if(Session::has("success_msg"))
                <div class="alert-success py-4 px-4 font-medium">{{ Session::get("success_msg")}}</div>
              @endif         
              @if($errors->any())
            <div class="alert-danger py-4">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif                   
              <!-- form start -->
              <form method="post" action="{{ route('admin.updateAdminDetails'); }}" id="frm1" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">                
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Type</label>
                    <input type="text" class="form-control" readonly="" value="{{$admin_details->type}}" name="admin_type">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" readonly="" value="{{$admin_details->email}}" name="admin_email">
                  </div>                  
                  <div class="form-group">
                    <label for="current_pwd">Name</label>
                    <input type="text" class="form-control" id="admin_name" value="{{$admin_details->name}}" placeholder="Enter Admin Name" name="admin_name">
                  </div>
                  <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" class="form-control" id="admin_mobile" placeholder="Enter Admin Mobile No." value="{{$admin_details->mobile}}" name="admin_mobile">
                  </div>
                  <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="admin_image"  name="admin_image" accept="image/*">
                    @if(!empty(Auth::guard("admin")->user()->image))
                        <a target="_blank" href="{{ url('/images/profile_images/'.$admin_details->image)}}">View Image</a>
                        <input type="hidden" name="old_image" value="{{ $admin_details->image}}">
                    @endif
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->    
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
@endsection