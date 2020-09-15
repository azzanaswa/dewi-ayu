@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('New Pengumuman Aded')</h3>
    {!! Form::open(['method' => 'POST', 'enctype' => 'multipart/form-data', 'route' => ['admin.pengumumans.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('Create Pengumuman')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', 'Judul Pengumuman*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('images', 'File (opsional)', ['class' => 'control-label']) !!}
                    {!! Form::file('images', old('images'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('images'))
                        <p class="help-block">
                            {{ $errors->first('images') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('file', 'File (opsional)', ['class' => 'control-label']) !!}
                    {!! Form::file('file', old('file'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('file'))
                        <p class="help-block">
                            {{ $errors->first('file') }}
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