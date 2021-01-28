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
<title>Leave Management | BrightAMS</title>
@endsection()
@section('main-content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="row ">
       <div class="col-lg-3">
        <h4 style="color:#065461">
          LEAVE MANAGEMENT
        </h4>
       </div>
       <div class="col-lg-7"></div>
       <div class="col-lg-2">
        <button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#userModal">
          <i class="fa fa-plus"></i> Add Leave
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
              <th>Leave Remarks</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
               
                    @foreach($leaves_data as $leave)
                    <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$leave->user->name}}</td>
                    <td>{{$leave->remarks}}</td>
                    <td>{{$leave->start_date_bs}}</td>
                    <td>{{$leave->end_date_bs}}</td>
                    <td>
                        @if($leave->status =='1')
                            <span style="background-color:green; padding:5px; border-radius:5px;">Approved</span>
                        
                        @else
                            <span style="background-color:red; padding:5px; border-radius:5px;">Not Approved</span>
                        
                        @endif
                    </td>
                    <td>
                        <a href="#" data-id="{{$leave->id}}" data-user_id="{{$leave->user_id}}" data-remarks="{{$leave->remarks}}" data-start_date="{{$leave->start_date_bs}}" data-end_date="{{$leave->end_date_bs}}"
                       data-status="{{$leave->status}}"    data-toggle="modal" data-target="#edituserModal"> <i class="fa fa-edit"></i></a>
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

  <!-- Create User Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="userModalLabel">Leave Manage</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('leave.store')}}" method="POST">
        @csrf
          <div class="row">
        
            <div class="col-md-6">
                <div class="form-group">
                    <label>Employee Name:<span style="color: red">*</span></label>
                    <select  class="form-control"  name="user_id" id="user_id" required>
                      <option value="">--Select--</option>
                      @foreach($users as $u)
                       
                       <option value="{{$u->id}}">{{$u->name}}</option>
      
                      @endforeach
                       
                    </select>

                </div>
           
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <label>Start Date:<span style="color: red">*</span></label>
                    <input type="date" class="form-control"  name="start_date_bs" id="start_date_bs">
               
                 </div>
     
            </div>
             
          </div>
          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label>Remarks:<span style="color: red">*</span></label>
                <textarea  class="form-control" name="remarks" id="remarks"></textarea>
                </div>
          
             </div>
            <div class="col-md-6">
               <div class="form-group">
                   <label>End Date:<span style="color: red">*</span></label>
                   <input type="date" class="form-control" name="end_date_bs" id="end_date_bs" >
               </div>
        
            </div>
          </div>
          <div class="row">
               <div class="col-md-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">--Select--</option>
                            <option value="1">Approved</option>
                            <option value="0">Not Approved</option>
                        </select>
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
    <!-- Create User Modal -->
<div class="modal fade" id="edituserModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="userModalLabel">Edit Leave Manage</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="" method="post" id="editForm">
          {{ csrf_field() }}
          {{method_field('put')}}
            <div class="row">
          
              <div class="col-md-6">
                  <div class="form-group">
                      <label>Employee Name:<span style="color: red">*</span></label>
                      <select   class="form-control"  name="user_id" id="edituser_id" required>
                        <option value="">--Select--</option>
                        @foreach($users as $u)
                         
                         <option value="{{$u->id}}" >{{$u->name}}</option>
        
                        @endforeach
                         
                      </select>
  
                  </div>
             
              </div>
              <div class="col-md-6">
                   <div class="form-group">
                      <label>Start Date:<span style="color: red">*</span></label>
                      <input type="date" class="form-control"  name="start_date_bs" id="editstart_date_bs">
                 
                   </div>
       
              </div>
               
            </div>
            <div class="row">
              <div class="col-md-6">
                 <div class="form-group">
                    <label>Remarks:<span style="color: red">*</span></label>
                  <textarea  class="form-control" name="remarks" id="editremarks"></textarea>
                  </div>
            
               </div>
              <div class="col-md-6">
                 <div class="form-group">
                     <label>End Date:<span style="color: red">*</span></label>
                     <input type="date" class="form-control" name="end_date_bs" id="editend_date_bs">
                 </div>
          
              </div>
            </div>
            <div class="row">
                 <div class="col-md-6">
                      <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="status" id="editstatus">
                              <option value="">--Select--</option>
                              <option value="1">Approved</option>
                              <option value="0">Not Approved</option>
                          </select>
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
    $('#edituserModal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget) 
  var id = button.data('id') 
  var user_id = button.data('user_id') 
  var remarks=button.data('remarks')
  var start_date_bs=button.data('start_date')
  var end_date_bs=button.data('end_date')
  var status=button.data('status')
  var modal = $(this)
  console.log(user_id);
  modal.find('.modal-body #id').val(id);
  modal.find('.modal-body #edituser_id').val(user_id)
  modal.find('.modal-body #editremarks').val(remarks)
  modal.find('.modal-body #editstart_date_bs').val(start_date_bs)
  modal.find('.modal-body #editend_date_bs').val(end_date_bs)
  modal.find('.modal-body #editstatus').val(status)

  
  modal.find('.modal-body #editForm').prop('action',`{{url('leave/${id}')}}`);
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