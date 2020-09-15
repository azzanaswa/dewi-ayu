@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Tags Panel')</h3>
    <p>
        <a href="#tag-create" data-toggle="modal" class="btn btn-success">Tamabah Tags Baru</a>
        
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            List Tags
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($tags) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                       
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>


                        <th>@lang('Nama Tag')</th>
                        <th>@lang('Dibuat pada')</th>
                        <th>@lang('Total Tag di Gunakan')</th>
                        <th width="14%">&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($tags) > 0)
                        @foreach ($tags as $tag)
                            <tr data-entry-id="{{ $tag->id }}">
                               
                                <td></td>

                                <td>{!! $tag->title !!}</td>
                                <td>{{date ('j F Y', strtotime($tag->created_at))}}</td>
                                @if ($tag->blogs()->count() > 0)
                                  <td>{{ $tag->blogs()->count() }} Posts</td>
                                @else
                                  <td>Tag tidak digunakan</td>
                                @endif
                                <td>  
                                    <a href="#{{$tag->id}}" data-toggle="modal" class="btn btn-xs btn-info">Edit</a>

                                    <a href="#{{$tag->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">Delete</a>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">Tidak Ditemukan Tags Pada Halaman ini</td>
                        </tr>
                    @endif


                        <div class="modal fade" id="tag-create" style="margin-top: 6%;"> 
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Tambah Tag Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{route('admin.tags.store')}}" method="POST" role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                          <input type="text" name="title" class="form-control" placeholder="Tulis Nama Tag di Sini">
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

                    
                    @foreach($tags as $tag)
                        <div class="modal fade" id="{{$tag->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit Tags</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{route('admin.tags.update',$tag->id)}}" method="post"
                                      role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        {{method_field('put')}}
                                        <div class="form-group">
                                          <input type="text" name="name" class="form-control" value="{{$tag->title}}">
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

                    @foreach($tags as $tag)
                      <div class="modal fade text-center" id="{{$tag->id}}-delete">
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
                                <p class="text-dark">Ingin menghapus tags dengan nama <b>"{{ $tag->title }}"</b></b>"?</p>
                              </div>
                              
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <form action="{{route('admin.tags.destroy',$tag->id)}}" method="post">
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