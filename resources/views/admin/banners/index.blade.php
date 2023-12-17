@extends('admin_layout.admin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Banners</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Banners</li>
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
                <h3 class="card-title">Banners</h3>
                <a href="{{ route('admin.add_edit_banners') }}" style="float:right; display:block-inline" class="btn btn-primary"> Add New Banner</a>                
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
                    <th>Title</th>
                    <th>Image</th>
                    <th>Link</th>
                    <th>alt</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($banners as $banner)  
                  <tr>
                      <td>{{$banner->id}}</td>
                      <td>{{$banner->title}}</td>
                      <td>@php $image_path = 'images/banner_images/'.$banner->image; @endphp
                          <img style="width:150px;" src="{{ asset($image_path)}}" alt="">
                      </td>
                      <td>{{$banner->link}}</td>
                      <td>{{$banner->alt}}</td>
                      <td>@if($banner->status == 1) 
                          <a href="javascript:void(0)" class="update-banner-status" id="banner-{{$banner->id}}" bannerid="{{$banner->id}}"><i class="fa fa-toggle-on" status="Active" aria-hidden="true"></i></a> 
                          @else 
                          <a href="javascript:void(0)" class="update-banner-status" id="banner-{{$banner->id}}" bannerid="{{$banner->id}}"><i class="fa fa-toggle-off" status="Inactive" aria-hidden="true"></i></a>                           
                          @endif
                          <a href="{{ route('admin.add_edit_banners',$banner->id) }}" alt="Edit banner"><i class="far fa-edit"></i></a>
                        &nbsp;&nbsp;
                        <a class="confirmDelete" record="banner" recordid="{{$banner->id}}" alt="Delete banner" name="banner" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a>                                              
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