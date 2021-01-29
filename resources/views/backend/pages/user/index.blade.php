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
              <th>Address</th>
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
                <td>{{$u->address}}</td>
                <td>{{$u->role_id == 0 ? 'Staff' : 'Super Administrator'}}</td>
              <th><a href="{{route('user.edit',$u->id)}}"><i class="fa fa-edit"></i></a> | <a href="{{route('user.edit',$u->id)}}" style="color: green"><i class="fa fa-eye"></i></a></th>
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
  <div class="modal-dialog modal-lg" role="document">
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
            <div class="col-md-4">
              <label for="name">Name <span style="color: red">*</span></label>
              <input type="text" class="form-control" name="name" id="name" maxlength="28" required placeholder="Enter name">
            </div>
            <div class="col-md-4">
              <label for="role">Role <span style="color: red">*</span></label>
              <select name="role" id="role" class="form-control" required>
                <option value="">---select role---</option>
                <option value="1">Admin</option>
                <option value="0">Staff</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="email">Email<span style="color: red">*</span></label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <label for="address">Address</label>
              <input type="text" class="form-control" name="address" id="address" placeholder="Enter address">
            </div>
              <div class="col-md-4">
                <label for="number">Number<span style="color: red">*</span></label>
                <input type="number" class="form-control" name="number" required id="number" placeholder="Enter number">
              </div>
              <div class="col-md-4">
                <label for="password">Password<span style="color: red">*</span></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
              </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <label for="dob">DOB</label>
              <input type="text" class="form-control" name="dob" id="dob" placeholder="Enter DOB">
            </div>
              <div class="col-md-4">
                <label for="bloodGroup">Blood Group</label>
                <input type="text" class="form-control" name="blood_group" id="bloodGroup" placeholder="Enter blood group">
              </div>
              <div class="col-md-4">
                <label for="idCardNumber">ID Card Number</label>
                <input type="text" class="form-control" name="id_card_number" id="idCardNumber" placeholder="Enter id card number">
              </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <label for="degination">Degination</label>
              <input type="text" class="form-control" name="degination" id="degination" placeholder="Enter degination">
            </div>
              <div class="col-md-4">
                <label for="joiningDate">Joining Date</label> 
                <input type="text" class="form-control" name="joining_date" id="joiningDate" placeholder="Enter joining date">
              </div>
              <div class="col-md-4">
                <label for="shift">Shift <span style="color: red">*</span></label> 
                <select name="shift" class="form-control" required>
                    <option value="">---select shift---</option>
                    @foreach($shifts as $s)
                        <option value="{{$s->id}}">{{$s->shift_name}}</option>
                    @endforeach
                </select>
              </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <label for="pan">Pan Number</label>
              <input type="text" class="form-control" name="pan_number" id="pan" placeholder="Enter pan number">
            </div>
              <div class="col-md-4">
                <label for="bankAccount">Back Account</label>
                <input type="text" class="form-control" name="bank_acount" id="bank_account" placeholder="Enter bank account">
              </div>
              <div class="col-md-4">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div>
@push('custom-script')
<script>
    $(document).ready(function(){
        /* Initialize NepaliDatepicker with options */
        $("#dob").nepaliDatePicker({
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 10
        });
        // datatable
        $('#usersTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    });
</script>@endpush
@endsection()