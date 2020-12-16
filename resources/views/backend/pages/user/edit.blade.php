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
<title>User Management | BrightAMS</title>
@endsection()
@section('main-content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="row ">
       <div class="col-lg-3">
        <h4 style="color:#065461">
          EDIT USER DETAILS
        </h4>
       </div>
     </div>
  </section>
  <section class="content">
    <div class="row form-group">
        <div class="col-md-6">
          <label for="name">Name <span style="color: red">*</span></label>
          <input type="text" class="form-control" name="name" id="name" maxlength="28" required>
        </div>
        <div class="col-md-6">
          <label for="role">Role <span style="color: red">*</span></label>
          <select name="role" id="role" class="form-control" required>
            <option value="">Select role...</option>
            <option value="0">Staff</option>
            <option value="2">Enroller</option>
            <option value="12">Manager</option>
            <option value="14">Super Administrator</option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-md-6">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" maxlength="8">
        </div>
      </div>
      <div class="row container">
          <input type="submit" class="btn btn-primary" value="Submit">
      <a href="{{route('user.index')}}"><input type="button" class="btn btn-warning" value="Close"></a>
      </div>
  </section>
@endsection()