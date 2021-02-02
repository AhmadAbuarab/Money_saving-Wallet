
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Saving money system</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">



</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">


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


        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="info">
                    <a href="#" class="d-block">Money Saving System</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin_home')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Home</p>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="nav-item">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">



        <div class="content">




            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Transactions Table</h3>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Birthdate</th>
                                        <th>Total Expensses</th>
                                        <th>Total Income</th>
                                        <th>Register Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user['name']}}</td>
                                            <td>{{$user['email']}}</td>
                                            <td>{{$user['mobile_number']}}</td>
                                            <td>{{$user['bdate']}}</td>
                                            <td>{{$user['total_incomes']}}</td>
                                            <td>{{$user['total_expenses']}}</td>
                                            <td>{{$user['created_at']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>








        </div>

    </div>



    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
        </div>
        <!-- Default to the left -->
    </footer>
</div>

</body>
<script src="{{asset('js/app.js')}}"> </script>

@yield('script')
</html>
