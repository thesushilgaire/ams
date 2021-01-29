@extends('backend.layouts.master')
@include('backend.layouts.styles')
@include('backend.layouts.header')
@include('backend.layouts.sidebar')
@include('backend.layouts.footer')
@include('backend.layouts.scripts')
{{-- @push('custom-styles')
    <link rel="stylesheet" href="#">
@endpush --}}
@section('page-title')
<title>Dashboard | Bright Attendance Management System</title>
@endsection()
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div>
        <div class="row">
        <a href="{{url('user')}}">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
              <span class="info-box-number">{{count($users)}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </a>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-user-plus"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Present Today</span>
              <span class="info-box-number">{{count($presentUsers)}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
  
          <!-- fix for small devices only -->
          <div class="clearfix visible-sm-block"></div>
  
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-user-times"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Absent Today</span>
                <span class="info-box-number">{{count($absentUsers)}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
            <!-- /.col -->
        <a href="{{url('holiday')}}">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-calendar-times-o"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">Total Holidays</span>
                <span class="info-box-number">{{count($totalHolidays)}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </a>
            <!-- /.col -->
        </div>
       
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      <div class="row">
        <div class="col-lg-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Present Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: block;">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>User</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($presentUsers as $a)
                    <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$a->name}}</td>
                      <td><span class="label label-success">Present</span></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-lg-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Absent Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: block;">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>User</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($absentUsers as $a)
                  <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$a->name}}</td>
                    <td><span class="label label-danger">Absent</span></td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-lg-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Leaves Today</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: block;">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>User</th>
                    <th>Remark</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($todayLeaves as $t)
                  <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$t->user->name}}</td>
                  <td><span class="label label-warning">{{$t->remarks}}</span></td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    

    </section>
    <!-- /.content -->

@endsection