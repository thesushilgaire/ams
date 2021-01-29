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
<title>Office Details Management | BrightAMS</title>
@endsection()
@section('main-content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="row ">
       <div class="col-lg-3">
        <h4 style="color:#065461">
          OFFICE DETAILS
        </h4>
       </div>
       <div class="col-lg-7"></div>
       <div class="col-lg-2">
        <button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#userModal">
          <i class="fa fa-plus"></i> Add Details
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
              <th>Office Name</th>
              <th>Address</th>
              <th>Phone No</th>
              <th>Email</th>
              <th>Logo</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
               
                    @foreach($details as $d)
                    <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$d->office_name}}</td>
                    <td>{{$d->address}}</td>
                    <td>{{$d->phone_no}}</td>
                    <td>{{$d->email}}</td>
                    <td>
                     <img src="{{asset('Images/Logo/'.$d->logo) }}" alt="" style="width:60px; height:60">
                    </td>
                    <td>
                       <a href="#" data-id="{{$d->id}}" data-name="{{$d->office_name}}" data-address="{{$d->address}}" data-phone_no="{{$d->phone_no}}"
                       data-email="{{$d->email}}"     data-toggle="modal" data-target="#editModal"> <i class="fa fa-edit"></i></a>
                    </td>
                   </tr>
                  @endforeach

             
              

            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
  </section>

  <!-- Create Holiday Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="userModalLabel">Office Details Manage</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('office_details.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label > Office Name:<span style="color: red">*</span></label>
                     <input type="text" class="form-control" name="name" id="name">

                </div>
           
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <label>Address:<span style="color: red">*</span></label>
                    <input type="text" class="form-control"  name="address" id="address">
               
                 </div>
     
            </div>
             
          </div>
          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                   <label>Phone No:<span style="color: red">*</span></label>
                   <input type="number" class="form-control" name="phone_no" id="phone_no" >
               </div>
        
            </div>
            <div class="col-md-6">
              <div class="form-group">
                  <label>Email:<span style="color: red">*</span></label>
                  <input type="email" class="form-control" name="email" id="email">
             </div>
             </div>
            </div>
          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                   <label>Logo:</label>
                   <input type="file" class="form-control" name="image" id="image" >
               </div>
        
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

  <!---Edit Modal-->
    <!-- Create Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="userModalLabel">Edit Holiday Manage</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="" method="post" id="editForm" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{method_field('put')}}
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label> Office Name:<span style="color: red">*</span></label>
                     <input type="text" class="form-control" name="name" id="editname">

                </div>
           
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <label>Address:<span style="color: red">*</span></label>
                    <input type="text" class="form-control"  name="address" id="editaddress">
               
                 </div>
     
            </div>
             
          </div>
          <div class="row">
             <div class="col-md-6">
               <div class="form-group">
                   <label>Phone No:<span style="color: red">*</span></label>
                   <input type="number" class="form-control" name="phone_no" id="editphone_no" >
               </div>
        
             </div>
            <div class="col-md-6">
              <div class="form-group">
                  <label>Email:<span style="color: red">*</span></label>
                  <input type="email" class="form-control" name="email" id="editemail">
               </div>
             </div>
        </div>

          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                   <label>Logo:</label>
                   <input type="file" class="form-control" name="image" id="editimage" >
               </div>
        
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
    $('#editModal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget) 
  var id = button.data('id') 
  var name=button.data('name')
  var address=button.data('address')
  var phone_no=button.data('phone_no')
  var email=button.data('email');

  var modal = $(this)
  
  modal.find('.modal-body #id').val(id);
  modal.find('.modal-body #editname').val(name)
  modal.find('.modal-body #editaddress').val(address)
  modal.find('.modal-body #editphone_no').val(phone_no)
  modal.find('.modal-body #editemail').val(email)
  

  
  modal.find('.modal-body #editForm').prop('action',`{{url('office_details/${id}')}}`);
  })
   </script>




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