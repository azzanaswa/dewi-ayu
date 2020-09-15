@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Panel Divisi')</h3>
    <p>
        <a href="#tag-create" data-toggle="modal" class="btn btn-success">Tamabah Program Kerja Baru</a>
        
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            Daftar Program Kerja
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($prokers) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('Contnet')</th>
                        <th>Dibuat Pada</th>
                        @can('can_admin')
                          <th>Pembuat</th>
                        @endcan
                        <th width="14%">&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($prokers) > 0)
                        @foreach ($prokers as $pro)
                            <tr data-entry-id="{{ $pro->id }}">                              
                                <td></td>
                                <td>{!! str_limit($pro->content, 50) !!}</td>
                                <td>{{date ('j F Y', strtotime($pro->created_at))}}</td>
                                @can('can_admin')
                                  <td>{{$pro->users->name}}</td>
                                @endcan
                                <td>  
                                    <a href="#{{$pro->id}}" data-toggle="modal" class="btn btn-xs btn-info">Edit</a>

                                    <a href="#{{$pro->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">Delete</a>

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
                                    <h5 class="modal-title">Tambah Program Kerja Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form enctype="multipart/form-data" action="{{route('admin.proker.store')}}" method="POST" role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('content', 'Isi Kontent', ['class' => 'control-label']) !!}
                                              {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'content']) !!}
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

                    
                    @foreach($prokers as $pro)
                        <div class="modal fade" id="{{$pro->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit Program Kerja</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form enctype="multipart/form-data" action="{{route('admin.proker.update',$pro->id)}}" method="post"
                                      role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        {{method_field('put')}}
                                        <div class="row">
                                          <div class="col-xs-12 form-group">
                                              {!! Form::label('content', 'Isi Kontent', ['class' => 'control-label']) !!}
                                              {!! Form::text('content', old('content'), ['class' => 'form-control', 'placeholder' => '']) !!}
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

                    @foreach($prokers as $pro)
                      <div class="modal fade text-center" id="{{$pro->id}}-delete">
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
                                <p class="text-dark">Ingin menghapus Program Kerja ini ?</p>
                              </div>
                              
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <form action="{{route('admin.proker.destroy',$pro->id)}}" method="post">
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

            var konten = document.getElementById("content");
              CKEDITOR.replace(konten,{
              language:'en-gb',
              filebrowserUploadUrl: "{{route('admin.upload', ['_token' => csrf_token() ])}}",
              filebrowserUploadMethod: 'form'
            });
        CKEDITOR.config.allowedContent = true;
    </script>
@endsection