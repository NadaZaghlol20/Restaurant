<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">
    <a href="#" class="brand-link">
        <div class="row justify-content-center my-2">
            <img src="{{ asset('storage/male.png') }}" alt="Logo" class="rounded-circle img-responsive elevation-3"
            style="opacity: 1;height:80px;">
        </div>
        <div class="row  justify-content-center">
            <h4 class="brand-text" style="color:white;">أطلب و إتمنى</h4>
        </div>
    </a>

    <ul class="c-sidebar-nav mt-2">
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-tachometer-alt c-sidebar-nav-icon"></i>الاشتراكات
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a href="/monthly_sub" class="c-sidebar-nav-link {{ url()->current()==url('monthly_subscription') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon"></i>الاشتراكات الشهرية
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href="/food_sub" class="c-sidebar-nav-link {{ url()->current()==url('live_description')  ? 'active' : '' }}">
                        <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon"></i>اشتراكات العيش
                    </a>
                </li>
            </ul>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="/restaurants" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>المطاعم
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="/menus" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>قائمة الطعام
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="/clients" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>العملاء
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="/deliveries" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>دليفرى
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="/orders" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>الطلبات
            </a>
        </li>
    </ul>
</div>
