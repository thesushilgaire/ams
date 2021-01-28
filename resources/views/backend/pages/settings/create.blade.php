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
<title>General Settings | BrightAMS</title>
@endsection()
@section('main-content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="row ">
      <div class="col-lg-3">
       <h4 style="color:#065461">
         GENERAL MANAGEMENT
       </h4>
      </div>
      <div class="col-lg-7"></div>
      <div class="col-lg-2">
       <button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#userModal">
         <i class="fa fa-plus"></i> Add 
       </button>
      </div>
    </div>
 </section>

  <!-- Main content -->
  <section class="content">

  <!-- /.box-header -->
  <div class="box-body">
    <table id="usersTable" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>SN</th>
        <th>Shift Name</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Ip Address</th>
        <th>Check In</th>
        <th>Check Out</th>
        <th>Check In Threshold</th>
        <th>Check Out Threshold</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
          @foreach($setting as $s)
            <tr>
                <td>{{$loop->index+1}}</td>
                 <td>{{$s->shift_name}}</td>
                 <td>{{$s->start_from_bs}}</td>
                 <td>{{$s->end_date_bs}}</td>
                 <td>{{$s->ip}}</td>
                 <td>{{$s->check_in}}</td>
                 <td>{{$s->check_out}}</td>
                 <td>{{$s->check_in_threshold}}</td>
                 <td>{{$s->check_out_threshold}}</td>
                 <td>
                     @if($s->status==1)
                     <span style="background-color:green; padding:5px ; border-radius:5px">Active</span>
                     @else
                     <span style="background-color:red; padding:5px; border-radius:5px">InActive</span>
                     @endif
                     
                 </td>
                 <td>
                    <a href="#" data-id="{{$s->id}}" data-name="{{$s->shift_name}}" data-start_date="{{$s->start_from_bs}}" data-end_date="{{$s->end_date_bs}}"
                        data-ip="{{$s->ip}}" data-check_in="{{$s->check_in}}"  data-check_out="{{$s->check_out}}" data-check_in_threshold="{{$s->check_in_threshold}}"
                        data-check_out_threshold="{{$s->check_out_threshold}}"  data-status="{{$s->status}}"
                       data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></a>

                 </td>

            </tr>

           
          @endforeach()
       
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->

<!-- /.box -->

</section>

  <!---Add Modal-->
  <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="userModalLabel">Add Setting</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                              
                      
             <form action="{{route('settings.store')}}" method="POST"> 
                @csrf
                      <div class="row">
                          <div class="form-group col-lg-4">
                              <label for="">Shift Name</label>
                          <input type="text"  class="form-control" name="shift_name" placeholder="Enter shift name">
                          </div>
                          <div class="form-group col-lg-4">
                              <label for="">Start Date</label>
                          <input type="text"  id="startDate" class="form-control" name="start_from_bs">
                          </div>
                          <div class="form-group col-lg-4">
                              <label for="">End Date</label>
                          <input type="text" id="endDate" class="form-control" name="end_date_bs">
                          </div>
                      </div>
                      <div class="row">
                          <div class="form-group col-lg-4">
                              <label for="">IP Address</label>
                          <input type="hidden" name="id" >
                          <input type="text" class="form-control" name="ip" required>
                          </div>
                          <div class="form-group col-lg-4">
                              <label for="">Check In</label>
                              <input type="text"  class="form-control" name="check_in" required>
                          </div>
                          <div class="form-group col-lg-4">
                              <label for="">Check Out</label>
                          <input type="text" class="form-control" name="check_out" required>
                          </div>
                      </div>
                      <div class="row">
                          <div class="form-group col-lg-4">
                              <label for="">Check In Threshold</label>
                          <input type="text" class="form-control" name="check_in_threshold" required>
                          </div>
                          <div class="form-group col-lg-4">
                              <label for="">Check Out Threshold</label>
                          <input type="text"  class="form-control" name="check_out_threshold" required>
                          </div>
                          <div class="form-group col-lg-4">
                              <label for="">Status</label><br>
                              <select name="status" id="editstatus" class="form-control">
                                <option value="" >--Select--</option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
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

<!--Edit Modal--->

 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="userModalLabel">Edit Setting</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
         <div class="modal-body">
                              
                      
             <form action="" method="post" id="editForm"> 
                {{ csrf_field() }}
                {{method_field('post')}}
         
                      <div class="row">
                          <div class="form-group col-lg-4">
                              <label for="">Shift Name</label>
                          <input type="text"  class="form-control" name="shift_name" id="editshift_name" placeholder="Enter shift name">
                          </div>
                          <div class="form-group col-lg-4">
                              <label for="">Start Date</label>
                          <input type="text" class="form-control" name="start_from_bs" id="editstart_from_bs">
                          </div>
                          <div class="form-group col-lg-4">
                              <label for="">End Date</label>
                          <input type="text"  class="form-control" name="end_date_bs" id="editend_date_bs">
                          </div>
                      </div>
                      <div class="row">
                          <div class="form-group col-lg-4">
                              <label for="">IP Address</label>
                          <input type="hidden" name="id" >
                          <input type="text" class="form-control" name="ip" id="editip" required>
                          </div>
                          <div class="form-group col-lg-4">
                              <label for="">Check In</label>
                              <input type="text"  class="form-control" name="check_in" id="editcheck_in" required>
                          </div>
                          <div class="form-group col-lg-4">
                              <label for="">Check Out</label>
                          <input type="text" class="form-control" name="check_out" id="editcheck_out" required>
                          </div>
                      </div>
                      <div class="row">
                          <div class="form-group col-lg-4">
                              <label for="">Check In Threshold</label>
                          <input type="text" class="form-control" name="check_in_threshold" id="editcheck_in_threshold" required>
                          </div>
                          <div class="form-group col-lg-4">
                              <label for="">Check Out Threshold</label>
                          <input type="text"  class="form-control" name="check_out_threshold" id="editcheck_out_threshold"  required>
                          </div>
                          <div class="form-group col-lg-4">
                              <label for="">Status</label><br>
                              <select name="status" id="editstatus" class="form-control">
                                  <option value="" disabled>--Select--</option>
                                  <option value="1">Active</option>
                                  <option value="0">InActive</option>
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
        $("#startDate,#endDate,#editstart_from_bs,#editend_date_bs").nepaliDatePicker({
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 10
        });
    });
</script>


<script>
    $('#editModal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget) 
  var id = button.data('id') 
  var name = button.data('name') 
  var ip = button.data('ip')
  var start_date = button.data('start_date') 
  var end_date = button.data('end_date') 
  var check_in = button.data('check_in') 
  var check_out = button.data('check_out') 
  var check_in_threshold = button.data('check_in_threshold') 
  var check_out_threshold = button.data('check_out_threshold') 
  var status= button.data('status') 
  
  var modal = $(this)
  
  modal.find('.modal-body #id').val(id);
  modal.find('.modal-body #editshift_name').val(name);
  modal.find('.modal-body #editip').val(ip);
  modal.find('.modal-body #editstart_from_bs').val(start_date);
  modal.find('.modal-body #editend_date_bs').val(end_date);
  modal.find('.modal-body #editcheck_in').val(check_in);
  modal.find('.modal-body #editcheck_out').val(check_out);
  modal.find('.modal-body #editcheck_in_threshold').val(check_in_threshold);
  modal.find('.modal-body #editcheck_out_threshold').val(check_out_threshold);
  modal.find('.modal-body #editstatus').val(status);
  
  modal.find('.modal-body #editForm').prop('action',`{{url('settings/update/${id}')}}`);
  })
   </script>

@endpush()

@endsection()