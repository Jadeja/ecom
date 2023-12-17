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
        <form @if(!empty($product['id'])) action="{{ route('admin.add_edit_products',$product->id) }}" @else action="{{ route('admin.add_edit_products') }}" @endif method="post" enctype="multipart/form-data">
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
                  <label>Category</label>
                  <select class="form-control select2" id="category_id" name="category_id" style="width: 100%;">
                    <option selected="selected">Select</option>
                    @foreach($sections as $section)
                      <optgroup label="{{$section->name}}"></optgroup>
                       @foreach($section->categories as $category)
                       <option value="{{$category->id}}"@if(!empty(old('category_id')) && old('category_id') == $category->id) selected @elseif(!empty($product['category_id']) && $product['category_id'] == $category->id) selected @endif>&nbsp;--&nbsp;{{$category->category_name}}</option>
                        @foreach($category->subcategories as $subcategory)
                          <option value="{{$subcategory->id}}" @if(!empty(old('category_id')) && old('category_id') == $subcategory->id) selected @elseif(!empty($product['category_id']) && $product['category_id'] == $subcategory->id) selected @endif>&nbsp;&nbsp;&nbsp;&rArr;&nbsp;&nbsp;{{$subcategory->category_name}}</option>
                        @endforeach 
                       @endforeach
                    @endforeach 
                  </select>
                </div>                    
              <div class="form-group">
                    <label for="exampleInputEmail1">Enter Product Name</label>
                    <input type="text" class="form-control" id="new_product" name="product_name" placeholder="Enter product Name" @if(!empty($product['product_name'])) value="{{ $product->product_name }}" @else value="{{ old('product_name') }}" @endif>
                  </div>                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Product Code</label>
                    <input type="text" class="form-control" id="new_product" name="product_code" placeholder="Enter product Code" @if(!empty($product['product_code'])) value="{{ $product->product_code }}" @else value="{{ old('product_code') }}" @endif>
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Product Color</label>
                    <input type="text" class="form-control" id="new_product" name="product_color" placeholder="Enter product Color" @if(!empty($product['product_color'])) value="{{ $product->product_color }}" @else value="{{ old('product_color') }}" @endif>
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Product Price</label>
                    <input type="text" class="form-control" id="new_product" name="product_price" placeholder="Enter product Price" @if(!empty($product['product_price'])) value="{{ $product->product_price }}" @else value="{{ old('product_price') }}" @endif>
                  </div> 
                <!-- /.form-group -->
                <div class="form-group">
                <label for="exampleInputEmail1">Product Discount</label>
                    <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="Enter product Discount" @if(!empty($product['product_discount'])) value="{{ $product->product_discount }}" @else value="{{ old('product_discount') }}" @endif>                  
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                <label for="exampleInputEmail1">Product Weight</label>
                    <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="Enter product weight" @if(!empty($product['product_weight'])) value="{{ $product->product_weight }}" @else value="{{ old('product_weight') }}" @endif>                  
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Wash Care</label>
                    <input type="text" class="form-control" id="wash_care" name="wash_care" placeholder="Enter Wash Care" @if(!empty($product['wash_care'])) value="{{ $product->wash_care }}" @else value="{{ old('wash_care') }}" @endif>                  
                </div>


                <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">@if(!empty($product['description'])) {{ $product->description }} @else {{ old('description') }} @endif</textarea>
                      </div>
                      <div class="form-group">
                        <label>Meta Description</label>
                        <textarea class="form-control" rows="3" name="meta_description" placeholder="Enter ...">@if(!empty($product['meta_description'])) {{ $product->meta_description }} @else {{ old('meta_description') }} @endif</textarea>
                      </div>        
                                         
              </div>
              <!-- /.col -->
              <div class="col-md-6">

                <div class="form-group">
                  <label for="exampleInputEmail1">Brand</label>
                  <select class="form-control select2" id="brand" name="brand" style="width: 100%;">
                      <option selected="selected" value="">Select</option>
                      @if(isset($brands))
                      @foreach($brands as $brand)
                      <option value="{{ $brand->id }}" @if(isset($product["brand_id"]) && $product["brand_id"] == $brand->id) selected @endif>{{ $brand->name }}</option>
                      @endforeach
                      @endif
                  </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Main Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="main_image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>                      
                    </div>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recommended Image Size : Width:1040px and Height:1200px</p>
                    <div>
                      @if(isset($product["main_image"]))
                      <img width="80px"  style="margin-top:5px;" src="{{ asset('images/product_images/small/'.$product['main_image']) }}" alt="">
                      &nbsp; <a class="confirmDelete" record="product-image" recordid="{{$product['id']}}" name="product" href="javascript:void(0)"> Delete </a>
                      @endif
                    </div>

                    <div class="form-group" style="margin-top:-25px;">
                    <label for="exampleInputFile">Product Video</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="product_video" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  @if(!empty($product['product_video']))
                  <div><a href="{{ url('videos/product_videos/'.$product['product_video']) }}" dawnload>Download</a>|
                  <a class="confirmDelete" record="product-video" recordid="{{$product['id']}}" name="product" href="javascript:void(0)"> Delete </a></div>
                  @endif
                <!-- /.form-group -->

                <div class="form-group">
                <label for="exampleInputEmail1">Fabric</label>
                <select class="form-control select2" id="fabric" name="fabric" style="width: 100%;">
                    <option selected="selected" value="">Select</option>
                    @if(isset($fabricArray))
                    @foreach($fabricArray as $fabric)
                     <option value="{{ $fabric }}" @if(isset($product["fabric"]) && $product["fabric"] == $fabric) selected @endif>{{ $fabric }}</option>
                    @endforeach
                    @endif
                </select>
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1">Pattern</label>
                <select class="form-control select2" id="pattern" name="pattern" style="width: 100%;">
                    <option selected="selected" value="">Select</option>
                    @foreach($patternArray as $pattern)
                     <option value="{{ $pattern }}" @if(isset($product["pattern"]) && $product["pattern"] == $pattern) selected @endif>{{ $pattern }}</option>
                    @endforeach
                </select>                
                </div>
                
                <div class="form-group">
                <label for="exampleInputEmail1">Sleeve</label>
                <select class="form-control select2" id="sleeve" name="sleeve" style="width: 100%;">
                    <option selected="selected" value="">Select</option>
                    @foreach($sleeveArray as $sleeve)
                     <option value="{{ $sleeve }}" @if(isset($product["sleeve"]) && $product["sleeve"] == $sleeve) selected @endif>{{ $sleeve }}</option>
                    @endforeach
                </select>                     
                </div>
                
                <div class="form-group">
                <label for="exampleInputEmail1">Fit</label>
                <select class="form-control select2" id="fit" name="fit" style="width: 100%;">
                    <option selected="selected" value="">Select</option>
                    @foreach($fitArray as $fit)
                     <option value="{{ $fit }}" @if(isset($product["fit"]) && $product["fit"] == $fit) selected @endif>{{ $fit }}</option>
                    @endforeach
                    
                </select>  
                </div>
                
                <div class="form-group">
                <label for="exampleInputEmail1">Occasion</label>
                <select class="form-control select2" id="occasion" name="occasion" style="width: 100%;">
                    <option selected="selected" value="">Select</option>
                    @foreach($occasionArray as $occasion)
                     <option value="{{ $occasion }}" @if(isset($product["occasion"]) && $product["occasion"] == $occasion) selected @endif>{{ $occasion }}</option>
                    @endforeach
                </select>                
                </div>

                <div class="form-group" style="margin-top:57px">
                  <label>Is Featured ?</label>
                  <input type="checkbox" name="is_featured" @if(!empty($product['is_featured']) && $product['is_featured']=="Yes" ) checked="checked" @elseif(!empty(old('is_featured')) && old('is_featured') == "on") checked="checked" @endif >
                </div>   

                <div class="form-group">
                  <label>Meta Titles</label>
                  <textarea class="form-control" name="meta_title" rows="3" placeholder="Enter ...">@if(!empty($product['meta_title'])) {{ $product->meta_title }} @else {{ old('meta_title') }} @endif</textarea>
                </div>
                <div class="form-group">
                  <label>Meta Keywords</label>
                  <textarea class="form-control" rows="3" name="meta_keywords" placeholder="Enter ...">@if(!empty($product['meta_keywords'])) {{ $product->meta_keywords }} @else {{ old('meta_keywords') }} @endif</textarea>
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

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection