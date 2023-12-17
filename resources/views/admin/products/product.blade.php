@extends('admin_layout.admin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
                <h3 class="card-title">Products</h3>
                <a href="{{ route('admin.add_edit_products') }}" style="float:right; display:block-inline" class="btn btn-primary"> Add New Product</a>
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
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Product Color</th>                                        
                    <th>Category</th>                                        
                    <th>Product Image</th>                                        
                    <th>Section</th>                                        
                    <th>Status</th>
                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($products as $product)                     
                  <tr>
                      <td>{{$product->id}}</td>
                      <td>{{$product->product_name}}</td>
                      <td>{{$product->product_code}}</td>
                      <td>{{$product->product_color}}</td>            
                      <td>{{$product->category->category_name}}</td>            
                      <td> @if(!empty($product->main_image) && file_exists("images/product_images/small/".$product->main_image))
                        <img width="100px" src="{{asset('/images/product_images/small/'.$product->main_image)}}" alt="">
                           @else 
                        <img width="100px" src="{{asset('/images/product_images/small/no-image.png')}}" alt="">
                           @endif
                      </td>            
                      <td>{{$product->section->name}}</td>            
                      <td>@if($product->status == 1) 
                          <a href="javascript:void(0)" class="update-product-status" id="product-{{$product->id}}" productid="{{$product->id}}"><i class="fa fa-toggle-on" status="Active" aria-hidden="true"></i></a> 
                          @else 
                          <a href="javascript:void(0)" class="update-product-status" id="product-{{$product->id}}" productid="{{$product->id}}"><i class="fa fa-toggle-off" status="Inactive" aria-hidden="true"></i></a>                           
                          @endif
                      </td>
                      <td>
                        <a href="{{ route('admin.add-product-attribute',$product->id) }}" alt="Add Product Attribute"><i class="fas fa-plus"></i></a>
                        <a href="{{ route('admin.add-images',$product->id) }}" alt="Add Product "><i class="fas fa-plus-circle"></i></a>
                        <a href="{{ route('admin.add_edit_products',$product->id) }}" alt="Edit Product"><i class="far fa-edit"></i></a>
                        &nbsp;&nbsp;
                        <a class="confirmDelete" record="product" recordid="{{$product->id}}" alt="Delete Product" name="Product" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a>
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