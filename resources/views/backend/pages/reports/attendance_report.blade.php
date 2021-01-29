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
           <form method="POST" action="{{route('attendance.fetch')}}">
            @csrf
            <div class="row">
                <div class="col-lg-12" >
                   
                        <div class="col-lg-3">
                            <input type="hidden" id="username" value="{{@$username}}">
                            <input type="hidden" id="fromDate" value="{{@$dateFrom}}">
                            <input type="hidden" id="toDate" value="{{@$dateTo}}">
                                <label for="">Select User</label>
                                <select id="user" name="user" class="form-control" style="width:100%" required>
                                    <option value="">Select User...</option>
                                    @foreach($users as $user)
                                <option value="{{$user->id}}" username="{{$user->name}}">{{$user->name}}</option>
                                    @endforeach()
                                </select>
                        </div>
                     
                        <div class="col-lg-3">
                            <label for="" style="color: #000">From</label>
                            <input type="text" id="dateFrom" name="date_from" class="form-control" value="{{substr(adToBs(date('Y-m-d')),0,7)}}-01" style="height:30px;width:90%">
                        </div>
                         
                        <div class="col-lg-3">
                            <label for="To" style="color:#000">To</label>
                            <input type="text" id="dateTo" name="date_to" class="form-control" value="{{adToBs(date('Y-m-d'))}}" style="height:30px;width:90%">
                        </div>
                        
                        <div class="col-lg-3">
                            <input type="submit" class="btn btn-primary" value="Search" id="search" style="margin-top: 28px">
                        </div>
           
                </form>
        </div>
    </div>
    <br/>
                <div class="row">
                    @if(@$username) <center> <h4 style="color: green">Attendance report of <b>{{@$username}}</b> from <b>{{@$dateFrom}}</b> to <b>{{@$dateTo}}</b></h4></center>@endif

                </div>
                <div class="row">
                    <div class="col-lg-12">

                  <table id="example1" class="table table-bordered table-hover text-nowrap" style="width:100%;background-color:#fff">
                        <thead>
                      
                        <tr>
                        <th>SN</th>
                            <th>Work Day</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Remark</th>
                        </tr>
                        </thead>
                        <tbody id="attendanceTableBody">
                            @if(@$finalReport)
                            @foreach ($finalReport as $index => $data)
                                <tr style="font-weight:600;color:@if(\Carbon\Carbon::parse(bsToad($data[0]['date']))->format('l') == 'Saturday') #fff @else #000  @endif;background-color:@if(\Carbon\Carbon::parse(bsToad($data[0]['date']))->format('l') == 'Saturday') #f95f3f  @endif">
                                <td>{{$loop->iteration}}</td>
                                <td>{{\Carbon\Carbon::parse(bsToad($data[0]['date']))->format('l')}}, {{ $data[0]['date']}}</td>
                                 <td> 
                                    @foreach ($data as $item)
                                            <span style="padding:5px">{{\Carbon\Carbon::parse($item['time'])->format('g:i A') == '12:00 AM' ? '': \Carbon\Carbon::parse($item['time'])->format('g:i A')}}</span><br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($data as $item)
                                        <span>{{$item['status']}}</span><br>
                                    @endforeach
                                </td>
                                <td>
                                    {{-- @foreach ($data as $item) --}}
                                        <span style="color:{{$data[0]['remark'] == 'Absent' ? '#fff' : ''}};background-color:{{$data[0]['remark'] == 'Absent' ? 'red' : ''}}">{{$item['remark']}}</span>
                                    {{-- @endforeach --}}
                                </td>
                                </tr>
                            @endforeach
                            @endif  
                        </tbody>
                        <tfoot>
                            <tr>
                            <td><label>Summary:</label></td>
                            <td><label> Present: {{@$countAttendance}} days</label></td>
                            <td><label>Absent: {{@$countAbsent}} days</label></td>
                            <td><label>Leaves: {{@$countLeaves}} days</label></td>
                            <td><label>Holidays: {{@$countHolidays}} days</label></td>
                            </tr>
                        </tfoot>
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
        "lengthMenu": [[32, 64,88,-1], [32, 64, 88,"All"]],
        "lengthChange": true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                footer: true,
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
                footer: true,
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
                footer: true,
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
