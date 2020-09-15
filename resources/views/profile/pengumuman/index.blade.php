@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Pengumuman Panel')</h3>
    <p>
        <a href="{{ route('admin.pengumumans.create') }}" class="btn btn-success">@lang('Tambah Pengumuman Baru')</a>
        
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('Pengumuman List')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($pengumumans) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('Judul')</th>
                        @can('can_admin')
                            <th>Penerbit</th>
                        @endcan
                        <th>@lang('Isi Konten')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($pengumumans) > 0)
                        @foreach ($pengumumans as $pengumuman)
                            <tr data-entry-id="{{ $pengumuman->id }}">
                               
                                    <td></td>
                                <td>{{ $pengumuman->title }}</td>
                                @can('can_admin')
                                    <td>{{$pengumuman->users->name}}</td>
                                @endcan
                                <td>{!! str_limit($pengumuman->content, 40) !!}</td>
                                <td>
                                    <a href="/profile_pmw/pengumuman/file/{{$pengumuman->file}}" download="{{$pengumuman->file}}" class="btn btn-xs btn-primary">@lang('download file')</a>
                                    <a href="{{ route('admin.pengumumans.show',$pengumuman->id) }}" class="btn btn-xs btn-primary">@lang('view')</a>
                                    <a href="{{ route('admin.pengumumans.edit',$pengumuman->id) }}" class="btn btn-xs btn-info">@lang('edit')</a>
                                    <a href="#{{$pengumuman->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">@lang('delete')</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('Tidak ada Data Pengumuman pada Halaman ini')</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            @foreach($pengumumans as $pengumuman)
                <div class="modal fade text-center" id="{{$pengumuman->id}}-delete">
                    <div class="modal-dialog" style="margin-top: 8%;">
                      <div class="modal-content">
                      
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title text-dark" style="text-align: center;">??? Apakah anda Yakin ???</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">
                          <i class="fa fa-exclamation-circle text-center" style="text-align: center; font-size: 140px; color: #ED4337; margin-top: -4%;"></i>
                          <h3 class="text-dark">Konfirmasi Hapus Blog Post dengan judul "<b>{{$pengumuman->title}}</b>"?</h3>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <form action="{{route('admin.pengumumans.destroy',$pengumuman->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger" >Hapus</button>
                          </form>
                        </div>
                        
                      </div>
                    </div>
                </div>
              @endforeach

        </div>
    </div>
@stop

@section('javascript') 
    <script>
            window.route_mass_crud_entries_destroy = '{{ route('admin.pengumumans.mass_destroy') }}';
    </script>
@endsection