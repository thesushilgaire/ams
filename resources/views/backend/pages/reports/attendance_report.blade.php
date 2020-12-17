@extends('backend.layouts.master')
@include('backend.layouts.styles')
@include('backend.layouts.header')
@include('backend.layouts.sidebar')
@include('backend.layouts.footer')
@include('backend.layouts.scripts')
@push('custom-styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
@endpush
@section('page-title')
<title>Attendance Report | BrightAMS</title>
@endsection

@section("main-content")
        <div class="content">
        <h4 style="color: #0e5461">ATTENDANCE REPORT</h4>
           <br>
            <div class="row">
                <div class="col-lg-12" >
                    <table id="example1" class="table table-bordered table-hover text-nowrap" style="width:100%;background-color:#fff">
                        <thead>
                            <tr style="background:white">
                                <td>
                                    <label for="">S</label>
                                    <select name="user" id="user" class="form-control" style="width:100%">
                                        <option value="">Select User...</option>
                                        @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach()
                                    </select>
                                </td>
                                <td>
                                    <label for="" style="color: #000">From</label>
                                <input type="text" id="dateFrom" class="form-control" value="{{adToBs(substr(\Carbon\Carbon::now()->subDays(30),0,10))}}" style="height:30px;width:90%"></td>
                                <td>
                                    <label for="To" style="color:#000">To</label>
                                    <input type="text" id="dateTo" class="form-control" value="{{adToBs(date('Y-m-d'))}}" style="height:30px;width:90%"></td>
                                    <td style="color: #000">
                                        <button id="search"><i class="fa fa-search" style="padding-left: 5px;padding-right:5px"></i></button>
                                    </td>
                            </tr>
                        <tr>
                            <th>S.N</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody id="attendanceTableBody">
                        
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    @push('custom-script')
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {

        /* Initialize NepaliDatepicker with options */
        $("#dateFrom,#dateTo").nepaliDatePicker({
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 10
        });
        // datatable fetching worksheet
      var oTable = $('#example1').DataTable({
        processing: true,
        serverSide: true,
        bLengthChange: false,
        searching:false,
        ordering:false,
        "paging": true,
        "displayStart": 0,
        "lengthMenu": [[32, 64,98,-1], [32, 64, 98,"All"]],
        "lengthChange": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            {
                extend: 'pdfHtml5',
                orientation: 'portrait',
                pageSize: 'A4'
            },
            {
                extend: 'print',
                messageTop: ''
            }
        ],
        ajax: {
            url: `{{url('/attendance/fetch-attendance')}}`,
            method:'POST',
            data: function(d){
                d._token = "{{ csrf_token() }}",
                d.userId = $('#user').val(),
                d.dateFrom = $("#dateFrom").val(),
                d.dateTo = $('#dateTo').val()
          }
          },
        "columns": [
          { data: 'DT_RowIndex', name: 'id' },
          { data: 'user', name: 'user' },
          { data: 'date', name: 'date' },
          { data: 'status', name: 'status' },
        ]
      });

      $("#search").click(function(e){
        oTable.draw();
      });
    });
</script>
@endpush
@endsection
