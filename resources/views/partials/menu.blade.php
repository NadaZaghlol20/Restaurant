<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">
    <div class="c-sidebar-brand d-md-down-none">
        <h4>اطلب و اتمنى</h4>
    </div>

    <ul class="c-sidebar-nav mt-2">
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-tachometer-alt c-sidebar-nav-icon"></i>الاشتراكات
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a href="{{route('monthly_subscription.index')}}" class="c-sidebar-nav-link {{ url()->current()==url('monthly_subscription') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon"></i>الاشتراكات الشهرية
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href="live_description" class="c-sidebar-nav-link {{ url()->current()==url('live_description')  ? 'active' : '' }}">
                        <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon"></i>اشتراكات العيش
                    </a>
                </li>
            </ul>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>المطاعم
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>العملاء
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>دليفرى
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>الطلبات
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="/logout" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt"></i>تسجيل خروج
            </a>
        </li>
    </ul>
</div>
