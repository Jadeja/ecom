@extends('admin_layout.admin_layout')
@section("content")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Advanced Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Advanced Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
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
        <form @if(!empty($brand['id'])) action="{{ route('admin.add_edit_brands',$brand->id) }}" @else action="{{ route('admin.add_edit_brands') }}" @endif method="post" enctype="multipart/form-data">
          @csrf
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Brand Name</label>
                    <input type="text" class="form-control" id="new_brand" name="brand_name" placeholder="Enter brand Name" @if(!empty($brand['name'])) value="{{ $brand->name }}" @else value="{{ old('name') }}" @endif>
                  </div>                                      
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          <button type="submit" class="btn btn-primary"> Submit </button>  
          </div>
        </div>
        </form>
        <!-- /.card -->

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection