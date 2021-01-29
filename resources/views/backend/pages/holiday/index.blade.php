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
<title>Holiday Management | BrightAMS</title>
@endsection()
@section('main-content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="row ">
       <div class="col-lg-3">
        <h4 style="color:#065461">
          HOLIDAY MANAGEMENT
        </h4>
       </div>
       <div class="col-lg-7"></div>
       <div class="col-lg-2">
        <button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#userModal">
          <i class="fa fa-plus"></i> Add Holiday
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
              <th>Start Date</th>
              <th>End Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
               
                    @foreach($holiday as $h)
                    <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$h->leave_name}}</td>
                    <td>{{$h->start_date_bs}}</td>
                    <td>{{$h->end_date_bs}}</td>
                    <td>
                        @if($h->status =='1')
                            <span class="badge btn-primary">Active</span>
                        
                        @else
                            <span class="badge btn-warning">InActive</span>
                        
                        @endif
                    </td>
                    <td>
                        <a href="#" data-id="{{$h->id}}" data-name="{{$h->leave_name}}" data-start_date="{{$h->start_date_bs}}" data-end_date="{{$h->end_date_bs}}"
                       data-status="{{$h->status}}"    data-toggle="modal" data-target="#editModal"> <i class="fa fa-edit"></i></a>
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
        <h4 class="modal-title" id="userModalLabel">Holiday Manage</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('holiday.store')}}" method="POST">
        @csrf
          <div class="row">
        
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name:<span style="color: red">*</span></label>
                     <input type="text" class="form-control" name="name" id="name" required placeholder="Enter name">

                </div>
           
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <label>Start Date:<span style="color: red">*</span></label>
                    <input type="text" class="form-control"  name="start_date_bs" id="start_date_bs" required placeholder="Start date">
               
                 </div>
     
            </div>
             
          </div>
          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                   <label>End Date:<span style="color: red">*</span></label>
                   <input type="text" class="form-control" name="end_date_bs" id="end_date_bs" required placeholder="End date">
               </div>
        
            </div>
            <div class="col-md-6">
              <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status" id="status" required>
                      <option value="1">Active</option>
                      <option value="0">In Active</option>
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
        <form action="" method="post" id="editForm">
          {{ csrf_field() }}
          {{method_field('put')}}
          <div class="row">
        
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name:<span style="color: red">*</span></label>
                     <input type="text" class="form-control" name="name" id="editname" required>

                </div>
           
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <label>Start Date:<span style="color: red">*</span></label>
                    <input type="text" class="form-control"  name="start_date_bs" id="editstart_date_bs" required>
               
                 </div>
     
            </div>
             
          </div>
          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                   <label>End Date:<span style="color: red">*</span></label>
                   <input type="text" class="form-control" name="end_date_bs" id="editend_date_bs" required>
               </div>
        
            </div>
        
               <div class="col-md-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="editstatus" required>
                            <option value="1">Active</option>
                            <option value="0">In Active</option>
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
    $('#editModal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget) 
  var id = button.data('id') 
  var name=button.data('name')
  var start_date_bs=button.data('start_date')
  var end_date_bs=button.data('end_date')
  var status=button.data('status')
  var modal = $(this)
  
  modal.find('.modal-body #id').val(id);
  modal.find('.modal-body #editname').val(name)
  modal.find('.modal-body #editstart_date_bs').val(start_date_bs)
  modal.find('.modal-body #editend_date_bs').val(end_date_bs)
  modal.find('.modal-body #editstatus').val(status)

  
  modal.find('.modal-body #editForm').prop('action',`{{url('holiday/${id}')}}`);
  })
   </script>
<script>
    $(document).ready(function(){
        /* Initialize NepaliDatepicker with options */
        $("#start_date_bs,#end_date_bs,#editstart_date_bs,#editend_date_bs").nepaliDatePicker({
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 10
        });

        // datatables
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