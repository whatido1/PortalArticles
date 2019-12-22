<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ $title }} | Admin</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset("bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("bower_components/admin-lte/dist/css/adminlte.min.css")}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Dropzone css -->
    <link rel="stylesheet" href="{{ asset('third-party/dropzone-js/dist/min/basic.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        {{-- Header / Navbar --}}
        {{-- @include('dashboard.admin.layout.header') --}}
        {{-- Sidebar --}}
        @include('dashboard.admin.layout.sidebar')



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ $title }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $message !!}
                    </div>
                    @endif
    
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $message !!}
                    </div>
                    @endif
    
                    @if ($message = Session::get('warning'))
                    <div class="alert alert-warning alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $message !!}
                    </div>
                    @endif
    
                    @if ($message = Session::get('info'))
                    <div class="alert alert-info alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $message !!}
                    </div>
                    @endif
    
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{-- Please check the form below for errors --}}
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @yield('content')
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        {{-- control sidebar --}}
        @include('dashboard.admin.layout.control-sidebar')
        {{-- footer --}}
        @include('dashboard.admin.layout.footer')



    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{asset("bower_components/admin-lte/plugins/jquery/jquery.min.js")}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset("bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("bower_components/admin-lte/dist/js/adminlte.min.js")}}"></script>
    <!-- tiny editor -->
    <script src="https://cdn.tiny.cloud/1/u87o99jlyhkfbn7r3b2rxclupq7chraszi0aozn67gd2m50e/tinymce/5/tinymce.min.js">
    </script>
    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- dropzone js -->
    <script src="{{ asset('third-party/dropzone-js/dist/min/dropzone.min.js') }}"></script>
    <script src="{{asset("asset/admin/main.js")}}"></script>
</body>

</html>