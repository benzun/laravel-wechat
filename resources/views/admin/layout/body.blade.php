<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/static/admin/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/static/admin/css/skins/_all-skins.min.css') }}">
    <link href="http://cdn.bootcss.com/iCheck/1.0.2/skins/flat/blue.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue sidebar-mini ">
<div class="wrapper">
    @include('admin.layout.header')
    @include('admin.layout.side')
    <div class="content-wrapper">
        <section class="content">
        </section>
    </div>
    @include('admin.layout.footer')
</div>
<script src="http://cdn.bootcss.com/jquery/2.2.3/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('/static/admin/js/app.min.js') }}"></script>
</body>
</html>