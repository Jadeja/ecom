@extends('admin_layout.admin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
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
                <h3 class="card-title">Categories</h3>
                <a href="{{ route('admin.add_edit_categories') }}" style="float:right; display:block-inline" class="btn btn-primary"> Add New Category</a>
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
                    <th>Parent Name</th>
                    <th>Section</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($categories as $category)  
                    @php $parentCat="Root"; @endphp
                    @if(!empty($category->parentCategory))
                     @php $parentCat=$category->parentCategory->category_name; @endphp
                    @endif
                  <tr>
                      <td>{{$category->id}}</td>
                      <td>{{$category->category_name}}</td>
                      <td>{{$parentCat}}</td>
                      <td>{{$category->section->name}}</td>
                      <td>{{$category->url}}</td>
                      <td>@if($category->status == 1) 
                          <a href="javascript:void(0)" class="update-category-status" id="category-{{$category->id}}" categoryid="{{$category->id}}"><i class="fa fa-toggle-on" status="Active" aria-hidden="true"></i></a> 
                          @else 
                          <a href="javascript:void(0)" class="update-category-status" id="category-{{$category->id}}" categoryid="{{$category->id}}"><i class="fa fa-toggle-off" status="Inactive" aria-hidden="true"></i></a>                           
                          @endif
                      </td>
                      <td>
                        <a href="{{ route('admin.add_edit_categories',$category->id) }}">Edit</a>
                        &nbsp;&nbsp;
                        <a class="confirmDelete" record="category" recordid="{{$category->id}}" name="Category" href="javascript:void(0)">Delete</a>
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