@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Tambah Lowongan Kerja Baru')</h3>
    {!! Form::open(['method' => 'POST', 'enctype' => 'multipart/form-data', 'route' => ['admin.lowongan-kerja.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('Data Lowongan Kerja')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cat_id', 'Kategori Lowongan Kerja', ['class' => 'control-label']) !!}
                    {!! Form::select('cat_id', $catlokers, old('cat_id'), ['class' => 'form-control' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cat_id'))
                        <p class="help-block">
                            {{ $errors->first('cat_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', 'Judul Lowongan Kerja*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('image', 'Post Image (primary)*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('nama_perusahaan', 'Nama Perusahaan*', ['class' => 'control-label']) !!}
                    {!! Form::text('nama_perusahaan', old('nama_perusahaan'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nama_perusahaan'))
                        <p class="help-block">
                            {{ $errors->first('nama_perusahaan') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('logo', 'Logo Perusahaan*', ['class' => 'control-label']) !!}
                    {!! Form::file('logo', old('logo'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('logo'))
                        <p class="help-block">
                            {{ $errors->first('logo') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('gaji', 'Gaji /bulan (kosongi jika tidak perlu)', ['class' => 'control-label']) !!}
                    {!! Form::number('gaji', old('gaji'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('content'))
                        <p class="help-block">
                            {{ $errors->first('gaji') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('cp', 'CP Perusahaan yang Bisa Dihubungi (Kosongi jika tidak ada)', ['class' => 'control-label']) !!}
                    {!! Form::number('cp', old('cp'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('content'))
                        <p class="help-block">
                            {{ $errors->first('cp') }}
                        </p>
                    @endif
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('content', 'Content*', ['class' => 'control-label']) !!}
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
    </div>

    <input type="submit" name="Save" class="btn btn-info">
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script>
        $("#selectbtn-tag").click(function(){
            $("#selectall-tag > option").prop("selected","selected");
            $("#selectall-tag").trigger("change");
        });
        $("#deselectbtn-tag").click(function(){
            $("#selectall-tag > option").prop("selected","");
            $("#selectall-tag").trigger("change");
        });

        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "Select tags here......",
                maximumSelectionLength: 4
            });
        });

        $('.date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        });

        $(document).ready(function() {

          $(".btn-img").click(function(){ 
              var html = $(".clone").html();
              $(".increment").after(html);
          });

          $(".btn-dest").click(function(){ 
              var html = $(".cln").html();
              $(".incrm").after(html);
          });

          $("body").on("click",".btn-danger",function(){ 
              $(this).parents(".control-group").remove();
          });

        });

        var konten = document.getElementById("content");
              CKEDITOR.replace(konten,{
              language:'en-gb',
              filebrowserUploadUrl: "{{route('admin.upload', ['_token' => csrf_token() ])}}",
              filebrowserUploadMethod: 'form'
            });
        CKEDITOR.config.allowedContent = true;
    </script>

@stop