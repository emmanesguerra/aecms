
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">-->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">AE CMS</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ route('setting.index') }}"><i class="fa fa-gears"></i> <span>Settings</span></a></li>
            <li><a href="{{ route('page.index') }}"><i class="fa fa-file-o"></i> <span>Pages</span></a></li>
            <li><a href="{{ route('module.index') }}"><i class="fa fa-cube"></i> <span>Modules</span></a></li>
            <li><a href="{{ route('user.index') }}"><i class="fa fa-user-o"></i> <span>Users</span></a></li>
            <li><a href="{{ route('permission.index') }}"><i class="fa fa-unlock-alt"></i> <span>User Permissions</span></a></li>
            <li><a href="{{ route('navigation.index') }}"><i class="fa fa-rss"></i> <span>Navigations</span></a></li>
        </ul>

        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">ADMIN CMS</li>
            
            @foreach(AEHelpers::getModules() as $modules)
                <li><a href="{{ route($modules->link) }}"><i class="fa {{ $modules->icon }}"></i> <span>{{ $modules->module_name }}</span></a></li>
            @endforeach
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>