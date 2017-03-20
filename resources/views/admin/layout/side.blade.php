<aside class="main-sidebar">
    <section class="sidebar">
        @if(!empty(session('wechat_account')))
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ \App\Http\Controllers\Common\Helper::getWechatHeadImgPath(session('wechat_account')->wechat_id) }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ session('wechat_account')->name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ $admin_config['account_type'][session('wechat_account')->type] }}</a>
                </div>
            </div>
        @endif

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="{{ action('Admin\IndexController@index') }}">
                    <i class="fa fa-wechat"></i> <span>公众号列表</span>
                </a>
            </li>

            @if(!empty(session('wechat_account')))
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                </ul>
            </li>
            @endif

        </ul>
    </section>
</aside>