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
<title>ATTENDANCE Management | BrightAMS</title>
@endsection()
@section('main-content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <h4 style="color:#065461">
      ATTENDANCE MANAGEMENT
    </h4>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <table id="usersTable" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>SN</th>
              <th>User</th>
              <th>Status</th>
              <th>Time</th>
            </tr>
            </thead>
            <tbody>
              @foreach($allAttendances as $a)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$a->user['name']}}</td>
                  <td>{{$a->status}}</td>
                  <td>{{$a->time_bs}}</td>
                </tr>
              @endforeach()
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
  </section>
@push('custom-script')
<script>
  $(function () {
    $('#usersTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@endpush
@endsection()