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
            <div class="form-group col-lg-6">
                <label for="">IP Address</label>
            <input type="hidden" name="id" value="{{@$settings->id}}">
            <input type="text" value="{{@$settings->ip}}" class="form-control" name="ip">
            </div>
            <div class="form-group col-lg-6">
                <label for="">Check In</label>
                <input type="text" value="{{@$settings->check_in}}" class="form-control" name="check_in">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="">Check Out</label>
            <input type="text" value="{{@$settings->check_out}}" class="form-control" name="check_out">
            </div>
            <div class="form-group col-lg-6">
                <label for="">Check In Threshold</label>
            <input type="text" value="{{@$settings->check_in_threshold}}" class="form-control" name="check_in_threshold">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="">Check Out Threshold</label>
            <input type="text" value="{{@$settings->check_out_threshold}}" class="form-control" name="check_out_threshold">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </div>
  </form>
      <!-- /.box -->
  </section>
@endsection()