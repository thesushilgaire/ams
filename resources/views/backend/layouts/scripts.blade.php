@section('scripts')
<!-- jQuery 2.2.3 -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset("assets/bootstrap/js/bootstrap.min.js")}}"></script>
<!-- SlimScroll -->
<script src="{{asset("assets/plugins/slimScroll/jquery.slimscroll.min.js")}}"></script>
<!-- FastClick -->
<script src="{{asset("assets/plugins/fastclick/fastclick.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("assets/dist/js/app.min.js")}}"></script>
<!-- PACE -->
<script src="{{asset("assets/plugins/pace/pace.min.js")}}"></script>
<script>
    $(document).ajaxStart(function() { Pace.restart(); });
</script>
<!-- DataTables -->
<script src="{{asset("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("assets/plugins/datatables/dataTables.bootstrap.min.js")}}"></script>
@endsection()