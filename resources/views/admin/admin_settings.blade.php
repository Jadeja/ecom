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
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              @if(Session::has("error_msg"))
                <div class="alert-danger py-4 px-4 font-medium">{{ Session::get("error_msg")}}</div>
              @endif
              @if(Session::has("success_msg"))
                <div class="alert-success py-4 px-4 font-medium">{{ Session::get("success_msg")}}</div>
              @endif              
              <!-- form start -->
              <form method="post" action="{{ route('admin.updatepwd');}}" id="frm1">
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
                    <label for="current_pwd">Current Password</label>
                    <input type="password" class="form-control" id="current_pwd" placeholder="Current Password" name="current_pwd">
                    <span id="current_pwd_check"></span>
                  </div>
                  <div class="form-group">
                    <label for="new_pwd">New Password</label>
                    <input type="password" class="form-control" id="new_pwd" placeholder="Enter New Password" name="new_pwd">
                  </div>
                  <div class="form-group">
                    <label for="confirm_pwd">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_pwd" placeholder="Enter Confirm Password" name="confirm_pwd">
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