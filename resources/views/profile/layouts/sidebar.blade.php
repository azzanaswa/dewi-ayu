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

            @can('can_all')
            <li class="{{ $request->segment(2) == 'pengumumans' ? 'active' : '' }}">
                <a href="{{ route('admin.pengumumans.index') }}">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="title">@lang('Pengumuman')</span>
                </a>
            </li>
            @endcan
            @can('can_all')
            <li class="{{ $request->segment(2) == 'gallerys' ? 'active' : '' }}">
                <a href="{{ route('admin.gallerys.index') }}">
                    <i class="fa fa-image"></i>
                    <span class="title">@lang('Gallery')</span>
                </a>
            </li>
            @endcan

            @can('can_all')
            <li class="{{ $request->segment(2) == 'panduans' ? 'active' : '' }}">
                <a href="{{ route('admin.panduans.index') }}">
                    <i class="fa fa-book"></i>
                    <span class="title">@lang('Dokumen')</span>
                </a>
            </li>
            @endcan
            
            @can('can_all')
            <li class="treeview {{ $request->segment(2) == 'background' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-tasks"></i>
                    <span class="title">@lang('Extra Content')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                <li class="{{ $request->segment(2) == 'background' ? 'active' : '' }}">
                    <a href="{{ route('admin.background.index') }}">
                        <i class="fa fa-tasks"></i>
                        <span class="title">@lang('Background')</span>
                    </a>
                </li>
                
                </ul>
            </li>
            @endcan
            
            @can('can_admin')
            <li class="{{ $request->segment(2) == 'users' ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('Daftar User')</span>
                </a>
            </li>
            @endcan
            
            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Ubah Password</span>
                </a>
            </li>

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
