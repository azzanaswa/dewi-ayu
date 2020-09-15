@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Panel Divisi')</h3>
    <p>
      @if($organisasi->count() != 1)
        <a href="#tag-create" data-toggle="modal" class="btn btn-success">Tamabah Foto Struktur Organisasi</a>
      @else
        <a href="#" class="btn btn-warning" disabled>Tamabah Foto Struktur Organisasi</a>
      @endif
        
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            Struktur Organisasi
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($organisasi) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th>@lang('Image')</th>
                        <th>Dibuat Pada</th>
                        <th width="14%">&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($organisasi) > 0)
                        @foreach ($organisasi as $org)
                            <tr data-entry-id="{{ $org->id }}">                              

                                <td width="120px"><img width="50%" height="40px" src="{{asset('profile/extra/'.$org->image)}}"></td>
                                <td>{{date ('j F Y', strtotime($org->created_at))}}</td>
                                <td>  
                                    <a href="#{{$org->id}}" data-toggle="modal" class="btn btn-xs btn-info">Edit</a>

                                    <a href="#{{$org->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">Delete</a>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">Tidak Ditemukan Detail Program Kerja Pada Halaman ini</td>
                        </tr>
                    @endif


                        <div class="modal fade" id="tag-create" style="margin-top: 6%;"> 
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Tambah Foto Struktur Organisasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form enctype="multipart/form-data" action="{{route('admin.organisasi.store')}}" method="POST" role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('image', 'Foto Struktur Organisasi*', ['class' => 'control-label']) !!}
                                              {!! Form::file('image', old('image'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                              <p class="help-block"></p>
                                              @if($errors->has('image'))
                                                  <p class="help-block">
                                                      {{ $errors->first('image') }}
                                                  </p>
                                              @endif
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

                    
                    @foreach($organisasi as $org)
                        <div class="modal fade" id="{{$org->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit Program Kerja</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form enctype="multipart/form-data" action="{{route('admin.organisasi.update',$org->id)}}" method="post"
                                      role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        {{method_field('put')}}
                                        <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('image', 'Foto Struktur Organisasi*', ['class' => 'control-label']) !!}
                                              {!! Form::file('image', old('image'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                              <p class="help-block"></p>
                                              @if($errors->has('image'))
                                                  <p class="help-block">
                                                      {{ $errors->first('image') }}
                                                  </p>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Perbaharui</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                      @endforeach

                </tbody>
            </table>
        </div>
    </div>
@stop


@section('javascript') 
    <script>
            window.route_mass_crud_entries_destroy = '{{ route('admin.tags.mass_destroy') }}';

            var konten = document.getElementById("content");
              CKEDITOR.replace(konten,{
              language:'en-gb',
              filebrowserUploadUrl: "{{route('admin.upload', ['_token' => csrf_token() ])}}",
              filebrowserUploadMethod: 'form'
            });
        CKEDITOR.config.allowedContent = true;
    </script>
@endsection