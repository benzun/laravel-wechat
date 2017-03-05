<header class="main-header">
    <a class="logo">
        <span class="logo-lg"><b>尊悦</b></span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="{{ url('admin/logout') }}" class="dropdown-toggle">
                        <img src="{{ asset('static/admin/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">退出登录</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>