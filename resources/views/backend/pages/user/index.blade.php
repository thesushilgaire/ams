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
              <th>Status</th>
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
                @if($u->status == 0) <td><span class="badge btn-warning">Inactive</span></td> @else <td><span class="badge btn-primary">Active</span> </td>@endif
              <th>
                <a href="#" data-id="{{$u->id}}" data-name="{{$u->name}}" data-email="{{$u->email}}" data-number="{{$u->number}}"
                 data-address="{{$u->address}}" data-role_id="{{$u->role_id}}"  data-dob="{{$u->dob}}" data-blood_group="{{$u->blood_group}}"
                 data-id_card="{{$u->id_card_number}}" data-degination="{{$u->degination}}" data-joining_date="{{$u->joining_date}}"
                 data-shift_id="{{$u->shift_id}}" data-pan_numner="{{$u->pan_number}}" data-bank_account="{{$u->bank_account}}" data-status="{{$u->status}}"
                data-toggle="modal" data-target="#usereditModal"><i class="fa fa-edit"></i></a>
                 |
                  <a href="#" data-id="{{$u->id}}" data-name="{{$u->name}}" data-email="{{$u->email}}" data-number="{{$u->number}}"
                    data-address="{{$u->address}}" data-role_id="{{$u->role_id}}"  data-dob="{{$u->dob}}" data-blood_group="{{$u->blood_group}}"
                    data-id_card="{{$u->id_card_number}}" data-degination="{{$u->degination}}" data-joining_date="{{$u->joining_date}}" data-password="{{$u->password}}"
                    data-shift_id="{{$u->shift_id}}" data-pan_numner="{{$u->pan_number}}" data-bank_account="{{$u->bank_account}}" data-status="{{$u->status}}"
                  style="color: green"  data-toggle="modal" data-target="#userdetailsModal"><i class="fa fa-eye"></i></a></th>
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


<!--EditUser Modal-->

<div class="modal fade" id="usereditModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="userModalLabel">User Edit Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST" id="editForm">
        {{ csrf_field() }}
        {{method_field('put')}}
      
          <div class="row form-group">
            <div class="col-md-4">
              <label for="name">Name <span style="color: red">*</span></label>
              <input type="text" class="form-control" name="name" id="editname" maxlength="28" required placeholder="Enter name">
            </div>
            <div class="col-md-4">
              <label for="role">Role <span style="color: red">*</span></label>
              <select name="role" id="editrole" class="form-control" required>
                <option value="">---select role---</option>
                <option value="1">Admin</option>
                <option value="0">Staff</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="email">Email<span style="color: red">*</span></label>
              <input type="email" class="form-control" name="email" id="editemail" placeholder="Enter email" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <label for="address">Address</label>
              <input type="text" class="form-control" name="address" id="editaddress" placeholder="Enter address">
            </div>
              <div class="col-md-4">
                <label for="number">Number<span style="color: red">*</span></label>
                <input type="number" class="form-control" name="number" required id="editnumber" placeholder="Enter number">
              </div>
              <div class="col-md-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="editpassword" placeholder="Enter password">
              </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <label for="dob">DOB</label>
              <input type="text" class="form-control" name="dob" id="editdob" placeholder="Enter DOB">
            </div>
              <div class="col-md-4">
                <label for="bloodGroup">Blood Group</label>
                <input type="text" class="form-control" name="blood_group" id="editbloodGroup" placeholder="Enter blood group">
              </div>
              <div class="col-md-4">
                <label for="idCardNumber">ID Card Number</label>
                <input type="text" class="form-control" name="id_card_number" id="editidCardNumber" placeholder="Enter id card number">
              </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <label for="degination">Degination</label>
              <input type="text" class="form-control" name="degination" id="editdegination" placeholder="Enter degination">
            </div>
              <div class="col-md-4">
                <label for="joiningDate">Joining Date</label> 
                <input type="text" class="form-control" name="joining_date" id="editjoiningDate" placeholder="Enter joining date">
              </div>
              <div class="col-md-4">
                <label for="shift">Shift <span style="color: red">*</span></label> 
                <select name="shift" class="form-control" id="editshift_id" required>
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
              <input type="text" class="form-control" name="pan_number" id="editpan" placeholder="Enter pan number">
            </div>
              <div class="col-md-4">
                <label for="bankAccount">Back Account</label>
                <input type="text" class="form-control" name="bank_acount" id="editbank_account" placeholder="Enter bank account">
              </div>
              <div class="col-md-4">
                <label for="status">Status</label>
                <select name="status" id="editstatus" class="form-control">
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


<!--Details Modal-->
  <div class="modal fade" id="userdetailsModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="userModalLabel">User Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
             <div class="col-md-6">
              <table style="text-align: center" id="usersTable" class="table table-bordered table-striped">

                <tbody>
                  <tr style="padding:100px">
                    <th>Name:</th>
                    <td><span id="detailsname"></span></td>
                  </tr>
                  <tr>
                    <th>Address:</th>
                    <td><span id="detailsaddress"></span></td>
                  </tr>
                  <tr>
                    <th>Email:</th>
                    <td><span id="detailsemail"></span></td>
                  </tr>
                  <tr>
                    <th>Role:</th>
                    <td><span id="detailsrole"></span></td>
                  </tr>
                  <tr>
                    <th>Number:</th>
                    <td><span id="detailsnumber"></span></td>
                  </tr>
                  <tr>
                    <th>DOB:</th>
                    <td><span id="detailsdob"></span></td>
                  </tr>
                  <tr>
                    <th>Blood Group:</th>
                    <td><span id="detailsbloodGroup"></span></td>
                  </tr>
                  
               </tbody> 
             </table>
            </div>

             
          <div class="col-md-6">
            <table  id="usersTable" class="table  table-striped">
   
                <tbody>
                 
                  <tr>
                    <th>Id CardNumber:</th>
                    <td><span id="detailsidCardNumber"></span></td>
                  </tr>
                  <tr>
                    <th>Degination:</th>
                    <td><span id="detailsdegination"></span></td>
                  </tr>
                  <tr>
                    <th>Joining Date:</th>
                    <td><span id="detailsjoiningDate"></span></td>
                  </tr>
                  <tr>
                    <th>Shift:</th>
                    <td><span id="detailsshift_id"></span></td>
                  </tr>
                  <tr>
                    <th>Pan Number:</th>
                    <td><span id="detailspan"></span></td>
                  </tr>
                  <tr>
                    <th>Bank Account:</th>
                    <td><span id="detailsbank_account"></span></td>
                  </tr>
                  <tr>
                    <th>Status:</th>
                    <td><span id="detailsstatus"></span></td>
                  </tr>
          
               </tbody> 
            </table>
 
           </div>
        </div>
     
       
  
     
     
      </div>
    </div>
  </div>
 </div>





@push('custom-script')

<script>
  $('#usereditModal').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 
var id = button.data('id') 
var name = button.data('name') 
var address = button.data('address') 
var number = button.data('number') 
var email = button.data('email') 
var role_id = button.data('role_id') 
var blood_group = button.data('blood_group') 
var dob = button.data('dob') 
var id_card = button.data('id_card') 
var pan_number = button.data('pan_number') 
var degination = button.data('degination') 
var shift_id = button.data('shift_id') 
var joining_date = button.data('joining_date') 
var bank_account = button.data('bank_account')
var status=button.data('status') 


var modal = $(this)

modal.find('.modal-body #id').val(id);
modal.find('.modal-body #editname').val(name);
modal.find('.modal-body #editaddress').val(address);
modal.find('.modal-body #editnumber').val(number);
modal.find('.modal-body #editemail').val(email);
modal.find('.modal-body #editrole').val(role_id);
modal.find('.modal-body #editbloodGroup').val(blood_group);
modal.find('.modal-body #editdob').val(dob);
modal.find('.modal-body #editidCardNumber').val(id_card);
modal.find('.modal-body #editpan').val(pan_number);
modal.find('.modal-body #editdegination').val(degination);
modal.find('.modal-body #editshift_id').val(shift_id);
modal.find('.modal-body #editjoiningDate').val(joining_date);
modal.find('.modal-body #editbank_account').val(bank_account);
modal.find('.modal-body #editstatus').val(status);

modal.find('.modal-body #editForm').prop('action',`{{url('user/${id}')}}`);
})
 </script>


<!--Details-->
<script>
  $('#userdetailsModal').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 
var id = button.data('id') 
var name = button.data('name') 
var address = button.data('address') 
var number = button.data('number') 
var email = button.data('email') 
var role_id = button.data('role_id') 
var blood_group = button.data('blood_group') 
var dob = button.data('dob') 
var id_card = button.data('id_card') 
var pan_number = button.data('pan_number') 
var degination = button.data('degination') 
var shift_id = button.data('shift_id') 
var joining_date = button.data('joining_date') 
var bank_account = button.data('bank_account')
var status=button.data('status') 
var password=button.data('password')
console.log(name);

var modal = $(this)

modal.find('.modal-body #id').text(id);
modal.find('.modal-body #detailsname').text(name);
modal.find('.modal-body #detailsaddress').text(address);
modal.find('.modal-body #detailsnumber').text(number);
modal.find('.modal-body #detailsemail').text(email);
modal.find('.modal-body #detailsrole').text(role_id);
modal.find('.modal-body #detailsbloodGroup').text(blood_group);
modal.find('.modal-body #detailsdob').text(dob);
modal.find('.modal-body #detailsidCardNumber').text(id_card);
modal.find('.modal-body #detailspan').text(pan_number);
modal.find('.modal-body #detailsdegination').text(degination);
modal.find('.modal-body #detailsshift_id').text(shift_id);
modal.find('.modal-body #detailsjoiningDate').text(joining_date);
modal.find('.modal-body #detailsbank_account').text(bank_account);
modal.find('.modal-body #detailsstatus').text(status);
modal.find('.modal-body #detailspassword').text(password)
})
 </script>



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