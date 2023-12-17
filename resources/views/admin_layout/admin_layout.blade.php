<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href={{url("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback")}}>
  <!-- Font Awesome -->
  <link rel="stylesheet" href={{url("plugins/fontawesome-free/css/all.min.css")}}>

  <link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/new_datatable.css')}}">
  <!-- Theme style -->
  <!-- Ionicons -->
  <link rel="stylesheet" href={{url("https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css")}}>
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href={{url("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}>
  <link rel="stylesheet" href={{url("plugins/select2/css/select2.min.css")}}>

  <!-- iCheck -->
  <link rel="stylesheet" href={{url("plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}>
  <!-- JQVMap -->
  <link rel="stylesheet" href={{url("plugins/jqvmap/jqvmap.min.css")}}>
  <!-- Theme style -->
  <link rel="stylesheet" href={{url("/css/admin_css/adminlte.min.css")}}>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href={{url("plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}>
  <!-- Daterange picker -->
  <link rel="stylesheet" href={{url("plugins/daterangepicker/daterangepicker.css")}}>
  <!-- summernote -->
  <link rel="stylesheet" href={{url("plugins/summernote/summernote-bs4.min.css")}}>
</head>
    
<body class="hold-transition sidebar-mini layout-fixed" style="background-color: #f4f6f9 !important;">
<div class="wrapper">

@include('admin_layout.admin_header');

@include('admin_layout.admin_sidebar');

@yield("content");


@include('admin_layout.admin_footer')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src={{ url("plugins/jquery/jquery.min.js")}}></script>
<!-- jQuery UI 1.11.4 -->
<script src={{ url("plugins/jquery-ui/jquery-ui.min.js")}}></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src={{ url("plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>

<!-- Select2 -->
<script src={{ url("plugins/select2/js/select2.full.min.js")}}></script>

<script src={{ url('plugins/datatables/new_datatable.js')}}></script>


<script>
  $(document).ready( function () {
    $('#example1').DataTable();
  
    //Initialize Select2 Elements
    $('.select2').select2()
} );
</script>

<!-- ChartJS -->

<script src={{ url("plugins/chart.js/Chart.min.js")}}></script>
<!-- Sparkline -->
<script src={{ url("plugins/sparklines/sparkline.js")}}></script>
<!-- JQVMap -->
<script src={{ url("plugins/jqvmap/jquery.vmap.min.js")}}></script>
<script src={{ url("plugins/jqvmap/maps/jquery.vmap.usa.js")}}></script>
<!-- jQuery Knob Chart -->
<script src={{ url("plugins/jquery-knob/jquery.knob.min.js")}}></script>
<!-- daterangepicker -->
<script src={{ url("plugins/moment/moment.min.js")}}></script>
<script src={{ url("plugins/daterangepicker/daterangepicker.js")}}></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src={{ url("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}></script>
<!-- Summernote -->
<script src={{ url("plugins/summernote/summernote-bs4.min.js")}}></script>
<!-- overlayScrollbars -->
<script src={{ url("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}></script>
<!-- AdminLTE App -->
<script src={{ url("js/admin_js/adminlte.js")}}></script>
<!-- AdminLTE for demo purposes -->
<script src={{ url("js/admin_js/demo.js")}}></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src={{ url("js/admin_js/pages/dashboard.js")}}></script>
<script src={{ url("js/admin_js/sweetalert2.js")}}></script>

<script src={{ url("js/admin_js/admin_script.js")}}></script>
</body>
</html>
