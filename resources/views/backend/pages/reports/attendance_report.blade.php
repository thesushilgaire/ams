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
<title>Attendance Report</title>
@endsection

@section("main-content")
        <div class="content">
        <h4 style="color: #0e5461">ATTENDANCE REPORT</h4>
           <br>
           <form method="POST" action="{{route('attendance.fetch')}}">
            @csrf
            <div class="row">
                <div class="col-lg-12" >
                  @if(@$username) <center> <h4>Attendance report of <b>{{@$username}}</b> from <b>{{@$dateFrom}}</b> to <b>{{@$dateTo}}</b></h4></center>@endif
                    <table id="example1" class="table table-bordered table-hover text-nowrap" style="width:100%;background-color:#fff">
                        <thead>
                            <tr style="background:white">
                                <td>
                                <input type="hidden" id="username" value="{{@$username}}">
                                <input type="hidden" id="fromDate" value="{{@$dateFrom}}">
                                <input type="hidden" id="toDate" value="{{@$dateTo}}">
                                    <label for="">S</label>
                                    <select id="user" name="user" class="form-control" style="width:100%" required>
                                        <option value="">Select User...</option>
                                        @foreach($users as $user)
                                    <option value="{{$user->id}}" username="{{$user->name}}">{{$user->name}}</option>
                                        @endforeach()
                                    </select>
                                </td>
                                <td>
                                    <label for="" style="color: #000">From</label>
                                <input type="text" id="dateFrom" name="date_from" class="form-control" value="{{adToBs(substr(\Carbon\Carbon::now()->subDays(30),0,10))}}" style="height:30px;width:90%"></td>
                                <td>
                                    <label for="To" style="color:#000">To</label>
                                    <input type="text" id="dateTo" name="date_to" class="form-control" value="{{adToBs(date('Y-m-d'))}}" style="height:30px;width:90%"></td>
                                    <td style="color: #000">
                                        <input type="submit" value="Search" id="search">
                                    </td>
                            </tr>
                        </form>
                        <tr>
                            <th>Day</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody id="attendanceTableBody">
                            @if(@$attendances)
                            @foreach ($attendances as $key => $data)
                            <tr>
                            <td>{{\Carbon\Carbon::parse($key)->format('l')}}</td>
                            <td>{{$key}}</td>
                            <td> 
                                @foreach ($data as $item)
                                        <span style="padding:5px">{{\Carbon\Carbon::parse($item->time_bs)->format('g:i A')}}</span><br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($data as $item)
                                    <span style="padding:5px">{{$item->status}}</span><br>
                                @endforeach
                            </td>
                            </tr>
                            @endforeach
                            @endif
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
        
        $("#dateFrom,#dateTo").nepaliDatePicker({
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 10
        });
        // datatable fetching worksheet
      var oTable = $('#example1').DataTable({
        bLengthChange: false,
        searching:false,
        ordering:false,
        "paging": true,
        "displayStart": 0,
        "lengthMenu": [[26, 52,78,-1], [26, 52, 78,"All"]],
        "lengthChange": true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                messageTop:function () {
                    let username = $('#username').val();
                    let from = $('#fromDate').val();
                    let to = $('#toDate').val();
                return `Attendance report of ${username} from ${from} to ${to}`;
            }
            },
            {
                extend: 'pdfHtml5',
                orientation: 'portrait',
                pageSize: 'A4',
                messageTop:function () {
                    let username = $('#username').val();
                    let from = $('#fromDate').val();
                    let to = $('#toDate').val();
                return `Attendance report of ${username} from ${from} to ${to}`;
            }
            },
            {
                extend: 'print',
                title:' ',
                messageTop: function () {
                    let username = $('#username').val();
                    let from = $('#fromDate').val();
                    let to = $('#toDate').val();
                return `<h3>Attendance report of <b>${username}</b> from <b>${from}</b> to <b>${to}</b></h3>`;
            }
                
            }
        ]
      });
    });
</script>
@endpush
@endsection
