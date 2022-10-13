<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Taxi System | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">

  @if(App::isLocale('en'))
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
  @else 
  <!-- Bootstrap 4 RTL -->
  {{-- <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"> --}}
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
  <!-- Custom style for RTL -->
  {{-- <link rel="stylesheet" href="{{asset('cms/dist/css/custom.css')}}"> --}}
  @endif

  <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
  @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Languages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-language"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">Languages</span>
          <div class="dropdown-divider"></div>
          <a href="{{route('change-language', 'ar')}}" class="dropdown-item">
            <i class="fas fa-globe-asia mr-2"></i> {{__('admin.arabic')}}
            <span class="float-right text-muted text-sm">@if(App::isLocale('ar')) Current @endif</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{route('change-language', 'en')}}" class="dropdown-item">
            <i class="fas fa-globe-asia mr-2"></i> {{__('admin.english')}}
            <span class="float-right text-muted text-sm">@if(App::isLocale('en')) Current @endif</span>
          </a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{count(auth()->user()->unreadNotifications)}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">{{count(auth()->user()->notifications)}} Notifications</span>
          <div class="dropdown-divider"></div>
          @foreach (auth()->user()->notifications as $notification)
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> {{$notification->data['title']}}
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
          @endforeach
          <a href="{{route('cms.notifications')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('cms/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('cms/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->full_name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li> -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          @canany(['Create-Admin', 'Read-Admins', 'Create-Driver', 'Read-Drivers'])
            <li class="nav-header">{{__('admin.hr')}}</li>
            @canany(['Create-Admin', 'Read-Admins'])
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>
                    {{__('admin.admins')}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  @can('Read-Admins')
                    <li class="nav-item">
                      <a href="{{route('admins.index')}}" class="nav-link">
                        <i class="fas fa-plus-square nav-icon"></i>
                        <p>{{__('admin.index')}}</p>
                      </a>
                    </li>
                  @endcan
                  @can('Create-Admin')
                    <li class="nav-item">
                      <a href="{{route('admins.create')}}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>{{__('admin.create')}}</p>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcanany
            @canany(['Create-Driver', 'Read-Drivers'])
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>
                    {{__('admin.drivers')}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  @can('Read-Drivers')
                    <li class="nav-item">
                      <a href="{{route('drivers.index')}}" class="nav-link">
                        <i class="fas fa-plus-square nav-icon"></i>
                        <p>{{__('admin.index')}}</p>
                      </a>
                    </li>
                  @endcan
                  @can('Create-Driver')
                    <li class="nav-item">
                      <a href="{{route('drivers.create')}}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>{{__('admin.create')}}</p>
                      </a>
                    </li>
                  @endcan 
                </ul>
              </li>
            @endcanany
          @endcanany

          @canany(['Create-Role', 'Read-Roles', 'Create-Permission', 'Read-Permissions'])
            <li class="nav-header">{{__('admin.authorization_management')}}</li>
            @canany(['Create-Role', 'Read-Roles'])
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>
                    {{__('admin.roles')}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  @can('Read-Roles')
                    <li class="nav-item">
                      <a href="{{route('roles.index')}}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>{{__('admin.index')}}</p>
                      </a>
                    </li>
                  @endcan
                  @can('Create-Role')
                    <li class="nav-item">
                      <a href="{{route('roles.create')}}" class="nav-link">
                        <i class="fas fa-plus-square nav-icon"></i>
                        <p>{{__('admin.create')}}</p>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcanany
            @canany(['Create-Permission', 'Read-Permissions'])
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>
                    {{__('admin.permissions')}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  @can('Read-Permissions')
                    <li class="nav-item">
                      <a href="{{route('permissions.index')}}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>{{__('admin.index')}}</p>
                      </a>
                    </li>
                  @endcan
                  @can('Create-Permission')
                    <li class="nav-item">
                      <a href="{{route('permissions.create')}}" class="nav-link">
                        <i class="fas fa-plus-square nav-icon"></i>
                        <p>{{__('admin.create')}}</p>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcanany 
          @endcanany
          
          @canany(['Create-Type', 'Read-Types', 'Create-City', 'Read-Cities'])
            <li class="nav-header">{{__('admin.content_manegement')}}</li>
            @canany(['Create-Type', 'Read-Types'])
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>
                    {{__('admin.types')}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  @can('Read-Types')
                    <li class="nav-item">
                      <a href="{{route('car-types.index')}}" class="nav-link">
                        <i class="fas fa-plus-square nav-icon"></i>
                        <p>{{__('admin.index')}}</p>
                      </a>
                    </li>
                  @endcan
                  @can('Create-Type')
                    <li class="nav-item">
                      <a href="{{route('car-types.create')}}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>{{__('admin.create')}}</p>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcanany
            @canany(['Create-City', 'Read-Cities'])
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-map-marker-alt"></i>
                <p>
                  {{__('admin.cities')}}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                @can('Read-Cities')
                <li class="nav-item">
                  <a href="{{route('cities.index')}}" class="nav-link">
                    <i class="fas fa-list nav-icon"></i>
                    <p>{{__('admin.index')}}</p>
                  </a>
                </li>
                @endcan
                @can('Create-City')
                <li class="nav-item">
                  <a href="{{route('cities.create')}}" class="nav-link">
                    <i class="fas fa-plus-square nav-icon"></i>
                    <p>{{__('admin.create')}}</p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>
            @endcanany
          @endcanany
          <li class="nav-header">{{__('admin.settings')}}</li>
          <li class="nav-item">
            <a href="{{route('auth.edit-profile')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>{{__('admin.edit_profile')}}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('auth.edit-password')}}" class="nav-link">
              <i class="nav-icon fas fa-unlock-alt"></i>
              <p>{{__('admin.change_password')}}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('auth.logout')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>{{__('admin.logout')}}</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('page-large-title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@yield('root-page-title')</a></li>
              <li class="breadcrumb-item active">@yield('page-small-title')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
{{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}
{{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script src="{{asset('js/axios.js')}}"></script>
<script src="{{asset('js/sweet_alert.js')}}"></script>
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('js/crud.js')}}"></script>

<!-- Bootstrap 4 rtl -->
{{-- <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script> --}}
@yield('scripts')
</body>
</html>
