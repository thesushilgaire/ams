@section('sidebar-content')
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset("assets/dist/img/logo.png")}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Bright Office</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="treeview">
        <a href="{{url('/dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Setup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{route('settings.index')}}"><i class="fa fa-circle-o"></i>General Setup</a></li>
          <li><a href="{{route('holiday.index')}}"><i class="fa fa-circle-o"></i>Public Holiday</a></li>
          <li><a href="{{route('office_details.index')}}"><i class="fa fa-circle-o"></i>Office Details</a></li>
          </ul>
        </li>
        <li>
        <a href="{{route('user.index')}}">
            <i class="fa fa-users"></i> <span>Employee Mgmt.</span>
          </a>
        </li>
        <li>
        <a href="{{route('attendance.index')}}">
            <i class="fa fa-clock-o"></i> <span>Attendance Mgmt.</span>
          </a>
        </li>
        <li>
          <a href="{{route('leave.index')}}">
              <i class="fa fa-th"></i> <span>Leave Mgmt1.</span>
            </a>
          </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{route('reports.index')}}"><i class="fa fa-circle-o"></i>Attendance Report</a></li>
          </ul>
        </li>
        <li>
          <a  href="{{ route('logout') }}"
          onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out"></i> <span>Logout</span>
            </a>
          </li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
              </form>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  @endsection()