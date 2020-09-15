@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Panel Divisi')</h3>
    <p>
        <a href="#tag-create" data-toggle="modal" class="btn btn-success">Tamabah Divisi Baru</a>
        
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            Daftar Divisi
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($divisis) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                       
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>Logo Divisi</th>
                        <th>@lang('Nama Divisi')</th>
                        <th>@lang('Dibuat pada')</th>
                        <th>@lang('Detail Divisi')</th>
                        <th width="14%">&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($divisis) > 0)
                        @foreach ($divisis as $divisi)
                            <tr data-entry-id="{{ $divisi->id }}">
                               
                                <td></td>

                                <td width="120px"><img width="50%" height="40px" src="{{asset('profile/extra/divisi/'.$divisi->image)}}"></td>
                                <td>{!! $divisi->title !!}</td>
                                <td>{{date ('j F Y', strtotime($divisi->created_at))}}</td>
                                <td>{!! str_limit($divisi->content, 40) !!}</td>
                                <td>  
                                    <a href="#{{$divisi->id}}" data-toggle="modal" class="btn btn-xs btn-info">Edit</a>

                                    <a href="#{{$divisi->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">Delete</a>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">Tidak Ditemukan Divisi Pada Halaman ini</td>
                        </tr>
                    @endif


                        <div class="modal fade" id="tag-create" style="margin-top: 6%;"> 
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Tambah Divisi Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form enctype="multipart/form-data" action="{{route('admin.divisi.store')}}" method="POST" role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('title', 'Nama Divisi*', ['class' => 'control-label']) !!}
                                              {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                                              <p class="help-block"></p>
                                              @if($errors->has('title'))
                                                  <p class="help-block">
                                                      {{ $errors->first('title') }}
                                                  </p>
                                              @endif
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('image', 'Logo Divisi (primary)*', ['class' => 'control-label']) !!}
                                              {!! Form::file('image', old('image'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                                              <p class="help-block"></p>
                                              @if($errors->has('image'))
                                                  <p class="help-block">
                                                      {{ $errors->first('image') }}
                                                  </p>
                                              @endif
                                          </div>
                                      </div>
                                       <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('content', 'Detail Divisi*', ['class' => 'control-label']) !!}
                                              {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'content']) !!}
                                              <p class="help-block"></p>
                                              @if($errors->has('content'))
                                                  <p class="help-block">
                                                      {{ $errors->first('content') }}
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

                    
                    @foreach($divisis as $divisi)
                        <div class="modal fade" id="{{$divisi->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit Divisi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form enctype="multipart/form-data" action="{{route('admin.divisi.update',$divisi->id)}}" method="post"
                                      role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        {{method_field('put')}}
                                        <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('title', 'Judul Post*', ['class' => 'control-label']) !!}
                                              <input type="text" name="title" class="form-control" required="" value="{{$divisi->title}}" placeholder="{{$divisi->title}}">
                                              <p class="help-block"></p>
                                              @if($errors->has('title'))
                                                  <p class="help-block">
                                                      {{ $errors->first('title') }}
                                                  </p>
                                              @endif
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('image', 'Post Image (primary)*', ['class' => 'control-label']) !!}
                                              <input type="file" name="image" class="form-control" value="{{$divisi->image}}" >
                                              <p class="help-block"></p>
                                              @if($errors->has('image'))
                                                  <p class="help-block">
                                                      {{ $errors->first('image') }}
                                                  </p>
                                              @endif
                                          </div>
                                      </div>
                                       <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('content', 'Content*', ['class' => 'control-label']) !!}
                                              <input type="text" name="content" class="form-control" required="" id="content" value="{{$divisi->content}}" placeholder="{!! $divisi->content !!}">
                                              <p class="help-block"></p>
                                              @if($errors->has('content'))
                                                  <p class="help-block">
                                                      {{ $errors->first('content') }}
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

                    @foreach($divisis as $divisi)
                      <div class="modal fade text-center" id="{{$divisi->id}}-delete">
                          <div class="modal-dialog" style="margin-top: 7%;">
                            <div class="modal-content">
                            
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title text-dark" style="text-align: center;">Apakah anda yakin ???</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                              </div>
                              
                              <!-- Modal body -->
                              <div class="modal-body">
                                <i class="fa fa-exclamation-circle text-center" style="text-align: center; font-size: 140px; color: #ED4337; margin-top: -4%;"></i>
                                <p class="text-dark">Ingin menghapus Divisi dengan nama <b>"{{ $divisi->title }}"</b></b>"?</p>
                              </div>
                              
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <form action="{{route('admin.divisi.destroy',$divisi->id)}}" method="post">
                                      {{csrf_field()}}
                                      {{method_field('DELETE')}}
                                  <button type="submit" class="btn btn-danger" >Hapus</button>
                                </form>
                              </div>
                              
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
    </script>
@endsection