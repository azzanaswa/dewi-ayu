@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Blog Panel')</h3>
    <p>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-success">@lang('Tambah Blog Baru')</a>
        
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('Posts List')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($blogs) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('Image')</th>
                        <th>@lang('Judul')</th>
                        @can('can_admin')
                            <th>Penerbit</th>
                        @endcan
                        <th>@lang('Isi Konten')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($blogs) > 0)
                        @foreach ($blogs as $blog)
                            <tr data-entry-id="{{ $blog->id }}">
                               
                                    <td></td>

                                <td width="120px"><img width="50%" height="40px" src="{{asset('profile/blog_images/'.$blog->image)}}"></td>
                                <td>{{ $blog->title }}</td>
                                @can('can_admin')
                                    <td>{{$blog->users->name}}</td>
                                @endcan
                                <td>{!! str_limit($blog->content, 40) !!}</td>
                                <td>
                                    <a href="{{ route('admin.blogs.show',$blog->id) }}" class="btn btn-xs btn-primary">@lang('view')</a>
                                    <a href="{{ route('admin.blogs.edit',$blog->id) }}" class="btn btn-xs btn-info">@lang('edit')</a>
                                    <a href="#{{$blog->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">@lang('delete')</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('Tidak ada Data Posts pada Halaman ini')</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            @foreach($blogs as $blog)
                <div class="modal fade text-center" id="{{$blog->id}}-delete">
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
                          <h3 class="text-dark">Konfirmasi Hapus Blog Post dengan judul "<b>{{$blog->title}}</b>"?</h3>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <form action="{{route('admin.blogs.destroy',$blog->id)}}" method="post">
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
            window.route_mass_crud_entries_destroy = '{{ route('admin.blogs.mass_destroy') }}';
    </script>
@endsection