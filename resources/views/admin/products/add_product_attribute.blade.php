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
        <form @if(!empty($product->id)) action="{{ route('admin.add-product-attribute',$product->id) }}" @else action="" @endif method="post" enctype="multipart/form-data">
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
                        <input type="text" style="width:110px" name="size[]" placeholder="Size"/>
                        <input type="text" style="width:110px" name="sku[]" placeholder="SKU"/>
                        <input type="text" style="width:110px" name="stock[]" placeholder="Stock"/>
                        <input type="text" style="width:110px" name="price[]" placeholder="Price"/>
                        <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
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
                       
                      <form action="{{route('admin.editAttribute')}}" method="post">
                <table id="example1" class="table table-bordered table-striped">
                  @csrf
                  
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Size</th>
                    <th>SKU</th>
                    <th>Stock</th>                                        
                    <th>Price</th>                                                       
                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($product->attributes as $attribute)   
                  <input type="text" style="display:none;" name="attributeId[]" value="{{$attribute->id}}">                  
                  <tr>
                      <td>{{$attribute->id}}</td>
                      <td>{{$attribute->size}}</td>
                      <td>{{$attribute->sku}}</td>
                      <td><input type="number" value="{{$attribute->stock}}" name="stock[]" require></td>            
                      <td><input type="number" value="{{$attribute->price}}" name="price[]" require></td>                                  
                      <td>
                        <a href="#" class="update-attribute-status" id="attribute-{{$attribute->id}}" attributeid="{{$attribute->id}}" alt="">@if($attribute->status == 1) Active @else Inactive @endif </a>
                        &nbsp;&nbsp;
                        <a class="confirmDelete" record="product-attribute" recordid="{{$attribute->id}}" alt="Delete Attribute" name="Attribute" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>                  
                </table>
              </div>
              <!-- /.card-body -->
          <!-- /.card-body -->
          <div class="card-footer">
          <button type="submit" class="btn btn-primary">updateAttribute</button>  
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