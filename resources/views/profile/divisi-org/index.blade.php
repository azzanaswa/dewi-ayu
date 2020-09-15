@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Divisi Organisasi')</h3>
    <p>
        <a href="{{ route('admin.divisi-org.create') }}" class="btn btn-success">@lang('Tambah Divisi Organisasi Baru')</a>
        
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('Divisi Organisasi List')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($orgs) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('Image')</th>
                        <th>@lang('Nama Organisasi')</th>
                        <th>Detail</th>
                        <th>@lang('Divisi')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($orgs) > 0)
                        @foreach ($orgs as $org)
                            <tr data-entry-id="{{ $org->id }}">
                               
                                    <td></td>

                                <td width="120px"><img width="50%" height="40px" src="{{asset('profile/extra/divisi/organisasi/'.$org->image)}}"></td>
                                <td>{{ $org->title }}</td>
                                <td>{!! str_limit($org->content, 40) !!}</td>
                                <td>{{$org->divisis->title}}</td>
                                <td>
                                    <a href="{{ route('admin.divisi-org.edit',$org->id) }}" class="btn btn-xs btn-info">@lang('edit')</a>
                                    <a href="#{{$org->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">@lang('delete')</a>
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

            @foreach($orgs as $org)
                <div class="modal fade text-center" id="{{$org->id}}-delete">
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
                          <h3 class="text-dark">Konfirmasi Hapus Divisi Organisasi "<b>{{$org->title}}</b>"?</h3>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <form action="{{route('admin.divisi-org.destroy',$org->id)}}" method="post">
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
            window.route_mass_crud_entries_destroy = '{{ route('admin.divisi-org.mass_destroy') }}';
    </script>
@endsection