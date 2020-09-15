@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Daftar Pengguna')</h3>
    @can('can_admin')
    <p>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">@lang('Tambah Pengguna Baru')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('data')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }} @can('can_admin') dt-select @endcan">
                <thead>
                    <tr>
                        @can('can_admin')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('Nama')</th>
                        <th>@lang('Email')</th>
                        <th>@lang('Hak Pengguna')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                @can('can_admin')
                                    <td></td>
                                @endcan

                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @if($user->role_id = 1)
                                    <td>Admin</td>
                                @else
                                    <td>Super Admin</td>
                                @endif
                                <td>
                                    @can('can_admin')
                                    <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('edit')</a>
                                    @endcan
                                    @can('can_admin')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Apakah anda Yakin ingin menghapus user dengan nama, ". $user->name)."');",
                                        'route' => ['admin.users.destroy', $user->id])) !!}
                                    {!! Form::submit(trans('delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('Tidak ada Data User pada Tabel ini.')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('can_admin')
            window.route_mass_crud_entries_destroy = '{{ route('admin.users.mass_destroy') }}';
        @endcan

    </script>
@endsection