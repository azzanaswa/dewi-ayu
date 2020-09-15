@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Panduan Panel')</h3>
    <p>
        <a href="#panduan-create" data-toggle="modal" class="btn btn-success">@lang('Tambah Panduan PMW Baru')</a>
        
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('Panduan List')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($panduans) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('File')</th>
                        <th>@lang('Judul')</th>
                        @can('can_admin')
                            <th>Penerbit</th>
                        @endcan
                        <th>@lang('di Buat Pada')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($panduans) > 0)
                        @foreach ($panduans as $panduan)
                            <tr data-entry-id="{{ $panduan->id }}">
                               
                                    <td></td>

                                <td>{!!$panduan->file!!}</td>
                                <td>{{ $panduan->title }}</td>
                                @can('can_admin')
                                    <td>{{$panduan->users->name}}</td>
                                @endcan
                                <td>{{date ('j F Y', strtotime($panduan->created_at))}}</td>
                                <td>
                                    <a href="/profile_pmw/panduan/{{$panduan->file}}" download="{{$panduan->file}}" class="btn btn-xs btn-primary">@lang('download file')</a>
                                    <a href="#{{$panduan->id}}-edit" data-toggle="modal" class="btn btn-xs btn-info">@lang('edit')</a>
                                    <a href="#{{$panduan->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">@lang('delete')</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('Tidak ada Data Panduan pada Halaman ini')</td>
                        </tr>
                    @endif
                </tbody>
            </table>

                    <div class="modal fade" id="panduan-create" style="margin-top: 2%;"> 
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Tambah Panduan Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{route('admin.panduans.store')}}" enctype='multipart/form-data' method="POST" role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        <div class="form-group input_fields_wrap_panduan">
                                          <a class="btn btn-info add_field_button_panduan">Add More Fields<small> (max 3)</small></a> 
                                          <div class="row">
                                              <div class="col-md-7">
                                                  {!! Form::label('title[]', 'Title*: ', ['class' => 'control-label']) !!}
                                                  {!! Form::textarea('title[]', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'max-height:100px;']) !!}  
                                              </div>
                                              <div class="col-md-5">
                                                  {!! Form::label('file[]', 'Gallery Image*', ['class' => 'control-label']) !!}
                                                  {!! Form::file('file[]', ['class' => 'form-control', 'placeholder' => '', 'style' => 'border: none;' ]) !!}
                                              </div>
                                          </div>
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>

            @foreach($panduans as $panduan)
                <div class="modal fade text-center" id="{{$panduan->id}}-delete">
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
                          <h3 class="text-dark">Konfirmasi Hapus Panduan PMW dengan Nama "<b>{{str_limit($panduan->title, 50)}}</b>"?</h3>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <form action="{{route('admin.panduans.destroy',$panduan->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger" >Hapus</button>
                          </form>
                        </div>
                        
                      </div>
                    </div>
                </div>
              @endforeach

              @foreach($panduans as $panduan)
                        <div class="modal fade" id="{{$panduan->id}}-edit">
                              <div class="modal-dialog" style="margin-top: 9%; max-width: 100%;">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit Panduan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  {!! Form::model($panduan, ['method' => 'PUT', 'enctype' => 'multipart/form-data', 'route' => ['admin.panduans.update', $panduan->id]]) !!}
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-7">
                                                {!! Form::label('title', 'Title*: ', ['class' => 'control-label']) !!}
                                                {!! Form::textarea('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'max-height:100px;']) !!}
                                            </div>

                                            <div class="col-md-5">
                                                {!! Form::label('file', 'File Panduan*', ['class' => 'control-label']) !!}
                                                {!! Form::file('file', ['class' => 'form-control', 'placeholder' => '', 'style' => 'border: none;' ]) !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.panduans.mass_destroy') }}';
    </script>
@endsection