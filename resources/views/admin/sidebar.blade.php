@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('Dashboard')</span>
                </a>
            </li>

            @can('can_admin')
            <li class="{{ $request->segment(2) == 'pelajarans' ? 'active' : '' }}">
                <a href="{{ route('admin.pelajarans.index') }}">
                    <i class="fa fa-book"></i>
                    <span class="title">@lang('Daftar Pelajaran')</span>
                </a>
            </li>
            @endcan

            @can('can_admin')
            <li class="{{ $request->segment(2) == 'jenjangs' ? 'active' : '' }}">
                <a href="{{ route('admin.jenjangs.index') }}">
                    <i class="fa fa-graduation-cap"></i>
                    <span class="title">@lang('Daftar Jenjang')</span>
                </a>
            </li>
            @endcan
            
            @can('can_admin')
            <li class="{{ $request->segment(2) == 'guru' ? 'active' : '' }}">
                <a href="{{ route('admin.guru.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('Guru Tervalidasi')</span>
                </a>
            </li>
            @endcan

            @can('can_admin')
            <li class="{{ $request->segment(2) == 'order' ? 'active' : '' }}">
                <a href="{{ route('admin.order.index') }}">
                    <i class="fa fa-reorder"></i>
                    <span class="title">@lang('All Order')</span>
                </a>
            </li>
            @endcan    

            @can('can_admin')
            <li class="{{ $request->segment(2) == 'pending/order' ? 'active' : '' }}">
                <a href="{{ route('admin.pending.index') }}">
                    <i class="fa fa-check"></i>
                    <span class="title">@lang('Order Need Acc')</span>
                </a>
            </li>
            @endcan 

            @can('can_admin')
            <li class="{{ $request->segment(2) == 'users' ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}">
                    <i class="fa fa-user"></i>
                    <span class="title">@lang('Pengguna Terdaftar')</span>
                </a>
            </li>
            @endcan
                    
            @can('can_admin')
            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Change password</span>
                </a>
            </li>
            @endcan

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">Log Out</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('quickadmin.logout')</button>
{!! Form::close() !!}
