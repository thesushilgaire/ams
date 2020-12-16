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
<title>ATTENDANCE REPORT | BrightAMS</title>
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
                                <th style="font-size:12px;color:black">Search By :</th>
                                <td><input type="text" id="user" class="form-control" placeholder="name" style="height:30px;width:100%"></td>
                                <td><input type="text" id="date" class="form-control" placeholder="date" style="height:30px;width:100%"></td>
                                <td><input type="text" id="status" class="form-control" placeholder="status" style="height:30px;width:100%"></td>
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
        // datatable fetching worksheet
        let user = $('#user').val();
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
            url: `{{url('/reports/fetch-attendance-report')}}`,
            method:'POST',
            data: function(d){
                d._token = "{{ csrf_token() }}",
                d.user = $('#user').val(),
                d.date = $("#date").val(),
                d.status = $("#status").val()
          }
          },
        "columns": [
          { data: 'DT_RowIndex', name: 'id' },
          { data: 'user', name: 'user' },
          { data: 'date', name: 'date' },
          { data: 'status', name: 'status' },
        ]
      });

      $("#user,#date,#status").keyup(function(e){
        oTable.draw();
      });
    });
</script>
@endpush
@endsection
