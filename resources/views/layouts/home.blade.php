<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link type="text/css"  href="/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/Ionicons/css/ionicons.min.css">

    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/css/bootstrapValidator.min.css">
    <link rel="stylesheet" href="/css/bootstrap-table.css">
    <link rel="stylesheet" href="/css/jquery-ui.min.css">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('path') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{ config('app.name', 'Laravel') }}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="/img/user2-160x160.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/img/user2-160x160.png" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/img/user2-160x160.png" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->name }}
                  <small>{{ Auth::user()->email }}</small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/img/user2-160x160.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      {{-- search form 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
       /.search form  --}}
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

        <li class="treeview @if(Request::is('home')) active @endif">
          <a href="@if(Request::is('home')) javascript:void @else {{ url('/home') }} @endif"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>

        {{-- Navigation --}}
          <li class="header">NAVIGATION</li>
          
          <li class="treeview @if(Request::is('sales/*')) active @endif">
            <a href="#">
              <i class="fa fa-shopping-cart"></i> <span>Sales</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@if(Request::is('sales/create')) active @endif"><a href="{{ url('/sales/create') }}"><i class="fa fa-circle-o"></i> Add Sales</a></li>
              <li class="@if(Request::is('sales/view')) active @endif"><a href="{{ url('/sales/view') }}"><i class="fa fa-circle-o"></i> View Sales</a></li>
            </ul>
          </li>

          <li class="treeview @if(Request::is('customer/*')) active @endif">
            <a href="#">
              <i class="fa fa-group"></i> <span>Customers</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@if(Request::is('customer/create')) active @endif"><a href="{{ url('/customer/create') }}"><i class="fa fa-circle-o"></i> Add Customer</a></li>
              <li class="@if(Request::is('customer/view')) active @endif"><a href="{{ url('/customer/view') }}"><i class="fa fa-circle-o"></i> View Customer</a></li>
            </ul>
          </li>

          <li class="treeview @if(Request::is('purchase/*')) active @endif">
            <a href="#">
              <i class="fa fa-shopping-bag"></i> <span>Purchase</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@if(Request::is('purchase/create')) active @endif"><a href="{{ url('/purchase/create') }}"><i class="fa fa-circle-o"></i> Add Purchase</a></li>
              <li class="@if(Request::is('purchase/view')) active @endif"><a href="{{ url('/purchase/view') }}"><i class="fa fa-circle-o"></i> View Purchase</a></li>
            </ul>
          </li>

          <li class="treeview @if(Request::is('supplier/*')) active @endif">
            <a href="#">
              <i class="fa fa-truck"></i> <span>Supplier</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@if(Request::is('supplier/create')) active @endif"><a href="{{ url('/supplier/create') }}"><i class="fa fa-circle-o"></i> Add Supplier</a></li>
              <li class="@if(Request::is('supplier/view')) active @endif"><a href="{{ url('/supplier/view') }}"><i class="fa fa-circle-o"></i> View Supplier</a></li>
            </ul>
          </li>

          <li class="treeview @if(Request::is('stock/*') || Request::is('category/*')) active @endif">
            <a href="#">
              <i class="fa fa-briefcase"></i> <span>Stocks / Product</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@if(Request::is('stock/create')) active @endif"><a href="{{ url('/stock/create') }}"><i class="fa fa-circle-o"></i> Add Stock / Product</a></li>
              <li class="@if(Request::is('stock/view')) active @endif"><a href="{{ url('/stock/view') }}"><i class="fa fa-circle-o"></i> View Stock / Product</a></li>
              <li class="@if(Request::is('category/create')) active @endif"><a href="{{ url('/category/create') }}"><i class="fa fa-circle-o"></i> Add Stock Category</a></li>
              <li class="@if(Request::is('category/view')) active @endif"><a href="{{ url('/category/view') }}"><i class="fa fa-circle-o"></i> View Stock Category</a></li>
              <li class="@if(Request::is('stock/view/availability')) active @endif"><a href="{{ url('/stock/view/availability') }}"><i class="fa fa-circle-o"></i> View Stock Availability</a></li>
            </ul>
          </li>

          <li class="treeview @if(Request::is('transaction/payments')) active @endif">
            <a href="@if(Request::is('transaction/payments')) javascript:void @else {{ url('/transaction/payments') }} @endif">
              <i class="fa fa-inr"></i> <span>Payments</span>
            </a>
          </li>

          <li class="treeview @if(Request::is('transaction/outstandings')) active @endif">
            <a href="@if(Request::is('transaction/outstandings')) javascript:void @else {{ url('/transaction/outstandings') }} @endif">
              <i class="fa fa-credit-card"></i> <span>Outstandings</span>
            </a>
          </li>

          <li class="treeview @if(Request::is('report/generate')) active @endif">
            <a href="@if(Request::is('report/generate')) javascript:void @else /report/generate @endif">
              <i class="fa fa-line-chart"></i> <span>Reports</span>
            </a>
          </li>

        {{-- END OF NAVIGATION --}}

        {{-- Direct Links --}}

          <li class="header">Direct Links</li>
          <li class="@if(Request::is('sales/create')) active @endif"><a href="@if(Request::is('sales/create')) javascript:void @else /sales/create @endif"><i class="fa fa-circle-o text-success"></i> <span>Add Sales</span></a></li>
          <li class="@if(Request::is('purchase/create')) active @endif"><a href="@if(Request::is('purchase/create')) javascript:void @else /purchase/create @endif"><i class="fa fa-circle-o text-red"></i> <span>Add Purchase</span></a></li>
          <li class="@if(Request::is('supplier/create')) active @endif"><a href="@if(Request::is('supplier/create')) javascript:void @else /supplier/create @endif"><i class="fa fa-circle-o text-aqua"></i> <span>Add Supplier</span></a></li>
          <li class="@if(Request::is('customer/create')) active @endif"><a href="@if(Request::is('customer/create')) javascript:void @else /customer/create @endif"><i class="fa fa-circle-o text-yellow"></i> <span>Add Customer</span></a></li>
          <li class="@if(Request::is('report/generate')) active @endif"><a href="@if(Request::is('report/generate')) javascript:void @else /report/generate @endif"><i class="fa fa-circle-o text-primary"></i> <span>Generate Report</span></a></li>

        {{-- END OF Direct Links --}}

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2017 <a href="http://www.firstfeetconsulting.com/" target="_blank">First Feet Business Services</a></strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="/js/app.js"></script>
<script src="/js/app.min.js"></script>
<script src="/js/bootstrapValidator.min.js"></script>
<script src="/js/default.js"></script>
<script src="/js/bootstrap-table.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/Chart.min.js"></script>
<script type="text/javascript" src="/js/barchart.js"></script>
</body>
</html>
