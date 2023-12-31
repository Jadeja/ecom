@extends('admin_layout.admin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sections</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sections</li>
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
                <h3 class="card-title">Sections</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($sections as $section)  
                  <tr>
                      <td>{{$section->id}}</td>
                      <td>{{$section->name}}</td>
                      <td>@if($section->status == 1) 
                          <a href="javascript:void(0)" class="update-status" id="section-{{$section->id}}" sectionid="{{$section->id}}"><i class="fa fa-toggle-on" status="Active" aria-hidden="true"></i></a> 
                          @else 
                          <a href="javascript:void(0)" class="update-status" id="section-{{$section->id}}" sectionid="{{$section->id}}"><i class="fa fa-toggle-off" status="Inactive" aria-hidden="true"></i></a>                           
                          @endif</td>
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