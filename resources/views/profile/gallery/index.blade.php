@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Gallery Panel')</h3>
    <p>
        <a href="{{ route('admin.gallerys.create') }}" class="btn btn-success">@lang('Tambah Foto Gallery Baru')</a>
        
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('Galleries List')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($gallerys) > 0 ? 'datatable' : '' }} dt-select">
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
                    @if (count($gallerys) > 0)
                        @foreach ($gallerys as $gallery)
                            <tr data-entry-id="{{ $gallery->id }}">
                               
                                    <td></td>

                                <td width="120px"><img width="50%" height="40px" src="{{asset('profile/gallery/'.$gallery->image)}}"></td>
                                <td>{{ $gallery->title }}</td>
                                @can('can_admin')
                                    <td>{{$gallery->users->name}}</td>
                                @endcan
                                @if($gallery->content == NULL)
                                <td> - </td>
                                @else
                                <td>{!! str_limit($gallery->content, 40) !!}</td>
                                @endif
                                <td>
                                    <a href="#{{$gallery->id}}-view" class="btn btn-xs btn-primary">@lang('view')</a>
                                    <a href="#{{$gallery->id}}-edit" data-toggle="modal" class="btn btn-xs btn-info">@lang('edit')</a>
                                    <a href="#{{$gallery->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">@lang('delete')</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('Tidak ada Data Foto Gallery pada Halaman ini')</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            @foreach($gallerys as $gallery)
                <div class="modal fade text-center" id="{{$gallery->id}}-delete">
                    <div class="modal-dialog" style="margin-top: 9%;">
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
                          <h3 class="text-dark">Konfirmasi Hapus Foto Gallery dengan Nama "<b>{{$gallery->title}}</b>"?</h3>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <form action="{{route('admin.gallerys.destroy',$gallery->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger" >Hapus</button>
                          </form>
                        </div>
                        
                      </div>
                    </div>
                </div>
              @endforeach

              @foreach($gallerys as $gallery)
                        <div class="modal fade" id="{{$gallery->id}}-edit">
                              <div class="modal-dialog" style="margin-top: 9%; max-width: 100%;">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit Gallery</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  {!! Form::model($gallery, ['method' => 'PUT', 'enctype' => 'multipart/form-data', 'route' => ['admin.gallerys.update', $gallery->id]]) !!}
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-7">
                                                {!! Form::label('title', 'Title*: ', ['class' => 'control-label']) !!}
                                                {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required']) !!}

                                                {!! Form::label('content', 'Content: ', ['class' => 'control-label']) !!}
                                                {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'placeholder' => '', 'style'=> 'max-height:80px;']) !!}
                                            </div>

                                            <div class="col-md-5">
                                                {!! Form::label('image', 'Gallery Image*', ['class' => 'control-label']) !!}
                                                {!! Form::file('image', ['class' => 'form-control', 'placeholder' => '', 'style' => 'border: none;' ]) !!}
                                            </div>
                                          </div>
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Perbaharui</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                  </div>
                                  {!! Form::close() !!}
                                </div>
                              </div>
                            </div>
                      @endforeach

        </div>
    </div>
@stop

@section('javascript') 
    <script>
            window.route_mass_crud_entries_destroy = '{{ route('admin.gallerys.mass_destroy') }}';
    </script>
@endsection