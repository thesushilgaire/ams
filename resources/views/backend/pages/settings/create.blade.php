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
    <h4 style="color:#065461">
      GENERAL MANAGEMENT
    </h4>
  </section>

  <!-- Main content -->
  <section class="content">
  <form action="{{route('settings.update')}}" method="POST"> 
            @csrf
        <div class="row">
            <div class="form-group col-lg-4">
                <label for="">Shift Name</label>
            <input type="text" value="{{@$settings->shift_name}}" class="form-control" name="shift_name" placeholder="Enter shift name">
            </div>
            <div class="form-group col-lg-4">
                <label for="">Start Date</label>
            <input type="text" value="{{@$settings->start_from_bs}}" id="startDate" class="form-control" name="start_from_bs">
            </div>
            <div class="form-group col-lg-4">
                <label for="">End Date</label>
            <input type="text" value="{{@$settings->end_date_bs}}" id="endDate" class="form-control" name="end_date_bs">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-4">
                <label for="">IP Address</label>
            <input type="hidden" name="id" value="{{@$settings->id}}">
            <input type="text" value="{{@$settings->ip}}" class="form-control" name="ip" required>
            </div>
            <div class="form-group col-lg-4">
                <label for="">Check In</label>
                <input type="text" value="{{@$settings->check_in}}" class="form-control" name="check_in" required>
            </div>
            <div class="form-group col-lg-4">
                <label for="">Check Out</label>
            <input type="text" value="{{@$settings->check_out}}" class="form-control" name="check_out" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-4">
                <label for="">Check In Threshold</label>
            <input type="text" value="{{@$settings->check_in_threshold}}" class="form-control" name="check_in_threshold" required>
            </div>
            <div class="form-group col-lg-4">
                <label for="">Check Out Threshold</label>
            <input type="text" value="{{@$settings->check_out_threshold}}" class="form-control" name="check_out_threshold" required>
            </div>
            <div class="form-group col-lg-4">
                <label for="">Status</label><br>
                <input type="checkbox" name="status" value="1" {{@$settings->status == '1' ? 'checked' : ''}}>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-4">
                <input type="submit" value="Update" class="btn btn-primary">
            <a href="{{route('dashboard')}}"><input type="button" value="Close" class="btn btn-warning"></a> 
            </div>
        </div>
  </form>
      <!-- /.box -->
  </section>

@push('custom-script')
<script>
    $(document).ready(function(){
        /* Initialize NepaliDatepicker with options */
        $("#startDate,#endDate").nepaliDatePicker({
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 10
        });
    });
</script>@endpush
@endsection()