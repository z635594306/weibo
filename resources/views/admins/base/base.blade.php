<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>微博后台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('admins/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome Icons -->
    <link href="{{asset('admins/bootstrap/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{asset('admins/bootstrap/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admins/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('admins/dist/css/skins/_all-skins.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="{{URL('admins/index')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>组</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>A组</b> 微博</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation"></nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('admins/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{ session('email')->email }}</p>
              <a href="{{ URL('admins/logout') }}"><i class="fa fa-circle text-success"></i> 退出</a>
            </div>
          </div>
    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">主导航</li>
            <!-- 权限管理 -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gittip"></i><span> 用户管理</span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{URL('admins/users')}}"><i class="fa fa-youtube-play"></i> 用户首页</a></li>
                <li class="active"><a href="{{URL('admins/users/add')}}"><i class="fa fa-youtube-play"></i> 添加用户</a></li>
              </ul>
            </li>
            <!-- 权限管理 -->

            <!-- 用户权限 -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gittip"></i><span> 用户权限</span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{URL('admins/powers')}}"><i class="fa fa-youtube-play"></i> 用户封禁/解封</a></li>
            </li>

              </ul>
            <!-- 用户权限 -->

            <!-- 微博管理 -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gittip"></i><span> 微博管理</span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{URL('admins/message')}}"><i class="fa fa-youtube-play"></i> 信息管理</a></li>
            </li>
            <!-- 微博管理 -->
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         @yield("content")
      </div><!-- /.content-wrapper -->
      
      <!-- footer -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>


      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    

  <!-- system modal end -->
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('admins/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('admins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('admins/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('admins/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admins/dist/js/app.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('admins/dist/js/demo.js')}}"></script>
    <!-- Modal提示框 -->
    <script src="{{asset('admins/bootstrap/js/ws-modal-alert-confirm.js')}}"></script>

     @if(session("err"))
        <script type="text/javascript">
            Modal.alert({msg: "{{session('err')}}",title: ' 信息提示',btnok: '确定',btncl:'取消'});
        </script>
     @endif
     @section('myscript')
     @show

     @yield("my-js")
  </body>
</html>
