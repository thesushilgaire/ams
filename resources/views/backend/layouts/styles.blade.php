  @section('styles')
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset("assets/bootstrap/css/bootstrap.min.css")}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset("assets/dist/css/AdminLTE.min.css")}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/skins/_all-skins.min.css')}}">
 <!-- Pace style -->
 <link rel="stylesheet" href="{{asset("assets/plugins/pace/pace.min.css")}}">
 {{-- nepali date picker --}}
 <link rel="stylesheet" href="{{asset('assets/dist/css/nepalidatepicker.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset("assets/plugins/datatables/dataTables.bootstrap.css")}}">
  <style>
    thead{
      background-color: #065461;
      color: #fff;
    }
    .pagination>.active>a{
      background-color: #065461;
    }
    .skin-blue .sidebar a {
      font-weight: 600;
    }
    .btn-primary{
      background-color: #065461;
    }
    .modal-header{
      background-color: #065461;
      padding: 0px;
      color:#fff;
      height: 35px;
    }
    .modal-title{
      margin-left:10px;
      margin-top: 5px;
    }
    .modal-header .close {
      margin-top: -24px;
      color:#fff;
      margin-right: 10px;
    }
    .dt-button{
      color:#fff;
      background-color: #065461;
      border-radius: 5px;
      border:1px solid#065461;
    }
    .skin-blue .main-sidebar, .skin-blue .left-side {
    background-color: #0e5461;
    }
  .skin-blue .main-header .logo {
    background-color: #0e5461;
    color: #fff;
    border-bottom: 1px solid #fff;
    border-right: 1px solid #fff;
    }
    .skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
    color: #fff;
    background: #3c763d;
    border-left-color: #d1bf24;
    } 
    .skin-blue .sidebar-menu>li>.treeview-menu {
    margin: 0 1px;
    background: #126271;
    }
    .skin-blue .treeview-menu>li>a {
    color: #fff;
    }
  </style>
@endsection()