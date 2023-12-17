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
              <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top:10px;">
                {{ Session::get("error_msg")}}
                  <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>                  
              @endif
              @if(Session::has("success_msg"))
              <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
                    {{ Session::get("success_msg")}}
                  <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>  
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
        <form @if(!empty($product->id)) action="{{ route('admin.add-images',$product->id) }}" @else action="" @endif method="post" enctype="multipart/form-data">
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
                    <label for="exampleInputEmail1">Enter Product Name </label> : {{ $product->product_name }}
                  </div>                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Product Code</label>  : {{ $product->product_code }}
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Product Color</label>  : {{ $product->product_color }}
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Product Price</label>  : {{ $product->product_price }}
                  </div> 
                 
                  <div class="field_wrapper">
                    <div>
                        <input type="file" multiple="" name="image[]" />             
                    </div>
                </div>                  
              </div>
              <!-- /.col -->
              <div class="col-md-6">        
                @if(isset($product->main_image))
                <img width="80px"  style="margin-top:5px;" src="{{ asset('images/product_images/small/'.$product->main_image) }}" alt="">
                &nbsp; 
                @endif              
              </div>
                 
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
  
<!-- card-start -->

<div class="card">
              <div class="card-header">
                <h3 class="card-title">Products</h3>
                <a href="{{ route('admin.add_edit_products') }}" style="float:right; display:block-inline" class="btn btn-primary"> Add New Product</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                       
                      <form action="editImage" method="post">
                <table id="example1" class="table table-bordered table-striped">
                  @csrf
                  
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Image</th>                                                    
                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($product->images as $image)   
                  <input type="text" style="display:none;" name="imageId[]" value="{{$image->id}}">                  
                  <tr>
                      <td>{{$image->id}}</td>
                      <td><img width="100px" src="{{asset('/images/product_images/small/'.$image->product_image)}}" alt=""></td>
                      <td>
                        <a class="update-product-image-status" style="cursor:pointer;" id="image-{{$image->id}}" imageid="{{$image->id}}" alt="">@if($image->status == 1) Active @else Inactive @endif </a>
                        &nbsp;&nbsp;
                        <a class="confirmDelete" record="product-image" recordid="{{$image->id}}" alt="Delete image" name="image" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>                  
                </table>
              </div>
              <!-- /.card-body -->
          <!-- /.card-body -->
          <div class="card-footer">
          <button type="submit" class="btn btn-primary">updateimage</button>  
         </form>
          </div>              
            </div>
            <!-- /.card -->
<!-- card-end -->    

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection