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
        <form @if(!empty($banner['id'])) action="{{ route('admin.add_edit_banners',$banner->id) }}" @else action="{{ route('admin.add_edit_banners') }}" @endif method="post" enctype="multipart/form-data">
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
                    <label for="exampleInputEmail1">Enter banner Title</label>
                    <input type="text" class="form-control" id="new_banner" name="title" placeholder="Enter banner Title" @if(!empty($banner['title'])) value="{{ $banner->title }}" @else value="{{ old('title') }}" @endif>
                  </div>                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Link</label>
                    <input type="text" class="form-control" id="new_banner" name="link" placeholder="Enter banner Link" @if(!empty($banner['link'])) value="{{ $banner->link }}" @else value="{{ old('link') }}" @endif>
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter banner Alt</label>
                    <input type="text" class="form-control" id="new_banner" name="alt" placeholder="Enter banner Alt" @if(!empty($banner['alt'])) value="{{ $banner->alt }}" @else value="{{ old('alt') }}" @endif>
                  </div> 
                  <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Is Active ?
                    <input type="checkbox" class="form-control" id="new_banner" name="status" placeholder="Banner Status" @if(!empty($banner['status'])) value="1" checked @else value="0" @endif>
                    </label>
                  </div>  -->
                                         
              </div>
              <!-- /.col -->
              <div class="col-md-6">
               
                <div class="form-group">
                    <label for="exampleInputFile">Main Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>                      
                    </div>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recommended Image Size : Width:1040px and Height:1200px</p>
                    <div>
                      @if(isset($banner["main_image"]))
                      <img width="80px"  style="margin-top:5px;" src="{{ asset('images/banner_images/small/'.$banner['main_image']) }}" alt="">
                      &nbsp; <a class="confirmDelete" record="banner-image" recordid="{{$banner['id']}}" name="banner" href="javascript:void(0)"> Delete </a>
                      @endif
                    </div>
                <!-- /.form-group -->                    
                                         
                <!-- /.form-group -->
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