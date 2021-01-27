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
<title>User Management | BrightAMS</title>
@endsection()
@section('main-content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="row ">
       <div class="col-lg-3">
        <h4 style="color:#065461">
          USER MANAGEMENT
        </h4>
       </div>
       <div class="col-lg-7"></div>
       <div class="col-lg-2">
        <button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#userModal">
          <i class="fa fa-plus"></i> Add User
        </button>
       </div>
     </div>
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
              <th>Name</th>
              <th>Email</th>
              <th>Number</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              @foreach($allUsers as $u)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$u->name}}</td>
                <td>{{$u->email}}</td>
                <td>{{$u->number}}</td>
                <td>{{$u->role_id == 0 ? 'Staff' : 'Super Administrator'}}</td>
              <th><a href="{{route('user.edit',$u->id)}}"><i class="fa fa-edit"></i></a></th>
              </tr>
            @endforeach()
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
  </section>

  <!-- Create User Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="userModalLabel">User Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('user.store')}}" method="POST">
        @csrf
          <div class="row form-group">
            <div class="col-md-6">
              <label for="name">Name <span style="color: red">*</span></label>
              <input type="text" class="form-control" name="name" id="name" maxlength="28" required>
            </div>
            <div class="col-md-6">
              <label for="role">Role <span style="color: red">*</span></label>
              <select name="role" id="role" class="form-control" required>
                <option value="">Select role...</option>
                <option value="0">Staff</option>
                <option value="2">Enroller</option>
                <option value="12">Manager</option>
                <option value="14">Super Administrator</option>
              </select>
            </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email">
              </div>
              <div class="col-md-6">
                <label for="number">Number</label>
                <input type="number" class="form-control" name="number" id="number">
              </div>
              <div class="col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
              </div>
          </div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>

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