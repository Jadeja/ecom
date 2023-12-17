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
        <form @if(!empty($category['id'])) action="{{ route('admin.add_edit_categories',$category->id) }}" @else action="{{ route('admin.add_edit_categories') }}" @endif method="post" enctype="multipart/form-data">
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
                    <label for="exampleInputEmail1">Enter Catergory Name</label>
                    <input type="text" class="form-control" id="new_category" name="category_name" placeholder="Enter Category Name" @if(!empty($category['category_name'])) value="{{ $category->category_name }}" @else value="{{ old('category_name') }}" @endif>
                  </div>                  
                  <div id="append_categories_level">
                    @include("admin.categories.append_categories_level")
                  </div>
                <!-- /.form-group -->
                <div class="form-group">
                <label for="exampleInputEmail1">Catergory Discount</label>
                    <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="Enter Category Discount" @if(!empty($category['category_discount'])) value="{{ $category->category_discount }}" @else value="{{ old('category_discount') }}" @endif>                  
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                        <label>Category Description</label>
                        <textarea class="form-control" name="category_description" rows="3" placeholder="Enter ...">@if(!empty($category['description'])) {{ $category->description }} @else {{ old('category_description') }} @endif</textarea>
                      </div>
                      <div class="form-group">
                        <label>Meta Description</label>
                        <textarea class="form-control" rows="3" name="meta_description" placeholder="Enter ...">@if(!empty($category['description'])) {{ $category->description }} @else {{ old('category_description') }} @endif</textarea>
                      </div>                      
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
                  <label>Sections</label>
                  <select class="form-control select2" id="section_id" name="section_id" style="width: 100%;">
                    <option selected="selected">Select</option>
                    @foreach($sections as $section)
                     <option value="{{ $section->id }}" @if($section->id == $category->section_id) selected @endif>{{ $section->name }}</option>
                    @endforeach
                  </select>
                </div>  

                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <div>
                      @if(isset($category->category_image))
                      <img width="80px"  style="margin-top:5px;" src="{{ asset('images/category_images/'.$category->category_image) }}" alt="">
                      &nbsp; <a class="confirmDelete" record="category-image" recordid="{{$category->id}}" name="Category" href="javascript:void(0)"> Delete </a>
                      @endif
                    </div>
                  </div>

                <!-- /.form-group -->
                <div class="form-group">
                <label for="exampleInputEmail1">Catergory URL</label>
                    <input type="text" class="form-control" id="new_category" name="url" placeholder="Enter Category URL" @if(!empty($category['url'])) value="{{ $category->url }}" @else value="{{ old('url') }}" @endif>                  
                </div>

                <div class="form-group">
                        <label>Meta Titles</label>
                        <textarea class="form-control" name="meta_title" rows="3" placeholder="Enter ...">@if(!empty($category['meta_title'])) {{ $category->meta_title }} @else {{ old('eta_title') }} @endif</textarea>
                      </div>
                      <div class="form-group">
                        <label>Meta Keywords</label>
                        <textarea class="form-control" rows="3" name="meta_keywords" placeholder="Enter ...">@if(!empty($category['meta_keywords'])) {{ $category->meta_keywords }} @else {{ old('meta_keywords') }} @endif</textarea>
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