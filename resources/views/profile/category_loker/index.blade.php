@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Panel Kategori Lowongan Kerja')</h3>
    <p>
        <a href="#categoryLoker-create" data-toggle="modal" class="btn btn-success">Tamabah Kategori Lowongan Kerja Baru</a>
        
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            Daftar Kategori Lowongan Kerja
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($catlokers) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                       
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>


                        <th>@lang('Nama Category')</th>
                        <th>@lang('Dibuat pada')</th>
                        <th>@lang('Total Lowongan Pada Category')</th>
                        <th width="14%">&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($catlokers) > 0)
                        @foreach ($catlokers as $cat)
                            <tr data-entry-id="{{ $cat->id }}">
                               
                                <td></td>

                                <td>{!! $cat->title !!}</td>
                                <td>{{date ('j F Y', strtotime($cat->created_at))}}</td>
                                @if ($cat->lokers->count() > 0)
                                  <td>{{ $cat->lokers->count() }} Lowongan</td>
                                @else
                                  <td>Belum ada Lowongan pada Kategori ini</td>
                                @endif
                                <td>  
                                    <a href="#{{$cat->id}}" data-toggle="modal" class="btn btn-xs btn-info">Edit</a>

                                    <a href="#{{$cat->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">Delete</a>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">Tidak Ditemukan Kategori Lowongan Kerja Pada Halaman ini</td>
                        </tr>
                    @endif


                        <div class="modal fade" id="categoryLoker-create" style="margin-top: 6%;"> 
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Tambah Kategori Lowongan Kerja Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{route('admin.category-loker.store')}}" method="POST" role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                          <input type="text" name="title" class="form-control" placeholder="Tulis Nama Kategori di Sini">
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

                    
                    @foreach($catlokers as $cat)
                        <div class="modal fade" id="{{$cat->id}}" style="margin-top: 6%;">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit Kategori Lowongan Kerja</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{route('admin.category-loker.update',$cat->id)}}" method="post"
                                      role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        {{method_field('put')}}
                                        <div class="form-group">
                                          <input type="text" name="title" class="form-control" value="{{$cat->title}}" placeholder="{{$cat->title}}">
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

                    @foreach($catlokers as $cat)
                      <div class="modal fade text-center" id="{{$cat->id}}-delete">
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
                                <p class="text-dark">Ingin menghapus Kategori Lowongan Kerja dengan Nama <b>"{{ $cat->title }}"</b></b>"?</p>
                              </div>
                              
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <form action="{{route('admin.category-loker.destroy',$cat->id)}}" method="post">
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