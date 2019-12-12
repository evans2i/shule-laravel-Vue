
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
  <li class="active">
    <a href="#">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
  </li>
  
  
  @can('isAdmin')
  
  <li class="treeview">
    <a href="#">
      <i class="fa fa-edit"></i><span>Users</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>

    <ul class="treeview-menu">
      <li class="active">
        <router-link to="/users">
        <i class="fa fa-users"></i> <span>All Users</span>
        </router-link>
      </li>
      <li>
        <router-link to="/UserAdd">
          <i class="fa fa-user-add"></i>  <span>Add User</span>
        </router-link>
      </li>
    </ul>
  </li>
  
  <li>

    <li class="treeview">
    <a href="#">
      <i class="fa fa-edit"></i><span>Students</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li>
        <router-link to="/students">
          <i class="fa fa-users"></i> <span>Students</span>
        </router-link>  
      </li>
      <li>
        <router-link to="/addstudents">
          <i class="fa fa-user-add"></i>  <span>Add Add Student</span>
        </router-link>
      </li>
    </ul>
  </li>
  
  <li>
 
  </li>
  <li>
    <router-link to="/staffs">
      <i class="fa fa-users"></i> <span>Staffs</span>
    </router-link>
  </li>
  @endcan
  <li>
    <router-link to="/subjects">
      <i class="fa fa-th"></i> <span>Subjects</span>
    </router-link>
  </li>
  <li>
    <router-link to="/levels">
      <i class="fa fa-th"></i> <span>Levels</span>
    </router-link>
  </li>
  <li>
    <router-link to="/streams">
      <i class="fa fa-th"></i> <span>Class</span>
    </router-link>
  </li>

  <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
  @yield('navbar')
  <li class="header">LABELS</li>
  <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
  <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
  <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
</ul>