@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Panel Background')</h3>
    <p>
        <a href="#tag-create" data-toggle="modal" class="btn btn-success">Tambah Background Slider</a>
        
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            Daftar Background Slider
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($backgorund) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                       
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>Foto Background</th>
                        <th>Title</th>
                        <th>Deskripsi</th>
                        <th>@lang('Dibuat pada')</th>
                        <th width="14%">&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($backgorund) > 0)
                        @foreach ($backgorund as $bg)
                            <tr data-entry-id="{{ $bg->id }}">
                               
                                <td></td>

                                <td width="120px"><img width="50%" height="40px" src="{{asset('profile/extra/background/'.$bg->image)}}"></td>
                                <td>{!! $bg->title !!}</td>
                                <td>{!! str_limit($bg->content, 40) !!}</td>
                                <td>{{date ('j F Y', strtotime($bg->created_at))}}</td>
                                <td>  
                                    <a href="#{{$bg->id}}" data-toggle="modal" class="btn btn-xs btn-info">Edit</a>

                                    <a href="#{{$bg->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">Delete</a>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">Tidak Ditemukan Background Slider Pada Halaman ini</td>
                        </tr>
                    @endif


                        <div class="modal fade" id="tag-create" style="margin-top: 6%;"> 
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Tambah Background Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form enctype="multipart/form-data" action="{{route('admin.background.store')}}" method="POST" role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('title', 'Nama Background*', ['class' => 'control-label']) !!}
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
                                              {!! Form::label('image', 'Foto Background (primary)*', ['class' => 'control-label']) !!}
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
                                              {!! Form::label('content', 'Detail Background*', ['class' => 'control-label']) !!}
                                              {!! Form::text('content', old('content'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'content']) !!}
                                              <p class="help-block"></p>
                                              @if($errors->has('content'))
                                                  <p class="help-block">
                                                      {{ $errors->first('content') }}
                                                  </p>
                                              @endif
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('category', 'Category Background*', ['class' => 'control-label']) !!}
                                              <select class="form-control" name="category">
                                                  <option value="Home Slider">Slider</option>
                                                  <option value="Other">Other</option>
                                              </select>
                                              <p class="help-block"></p>
                                              @if($errors->has('category'))
                                                  <p class="help-block">
                                                      {{ $errors->first('category') }}
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

                    
                    @foreach($backgorund as $bg)
                        <div class="modal fade" id="{{$bg->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit Background</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form enctype="multipart/form-data" action="{{route('admin.background.update',$bg->id)}}" method="post"
                                      role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        {{method_field('put')}}
                                        <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('title', 'Judul Post*', ['class' => 'control-label']) !!}
                                              <input type="text" name="title" class="form-control" required="" value="{{$bg->title}}" placeholder="{{$bg->title}}">
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
                                              <input type="file" name="image" class="form-control" value="{{$bg->image}}" >
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
                                              <input type="text" name="content" class="form-control" id="content" value="{{$bg->content}}" placeholder="{!! $bg->content !!}">
                                              <p class="help-block"></p>
                                              @if($errors->has('content'))
                                                  <p class="help-block">
                                                      {{ $errors->first('content') }}
                                                  </p>
                                              @endif
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('category', 'Content*', ['class' => 'control-label']) !!}
                                              <select class="form-control" name="category">
                                                  <option value="Home Slider">Slider</option>
                                                  <option value="Other">Other</option>
                                              </select>
                                              <p class="help-block"></p>
                                              @if($errors->has('category'))
                                                  <p class="help-block">
                                                      {{ $errors->first('category') }}
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

                    @foreach($backgorund as $bg)
                      <div class="modal fade text-center" id="{{$bg->id}}-delete">
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
                                <p class="text-dark">Ingin menghapus Background <b>"{{ $bg->category }}"</b></b>"?</p>
                              </div>
                              
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <form action="{{route('admin.background.destroy',$bg->id)}}" method="post">
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