@extends('profile.layouts.admin')

@section('content')
    <h3 class="page-title">@lang('Buat Foto Gallery')</h3>
    {!! Form::open(['method' => 'POST', 'enctype' => 'multipart/form-data', 'route' => ['admin.gallerys.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('create')
        </div>
        
        <div class="panel-body">
                             <div class="form-group input_fields_wrap">
                                <a class="btn btn-info add_field_button">Add More Fields<small> (max 4)</small></a> 
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::label('title[]', 'Title*: ', ['class' => 'control-label']) !!}
                                        {!! Form::text('title[]', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required']) !!}

                                        {!! Form::label('content[]', 'Content: ', ['class' => 'control-label']) !!}
                                        {!! Form::textarea('content[]', old('content'), ['class' => 'form-control', 'placeholder' => '', 'style'=> 'max-height:80px;']) !!}
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        {!! Form::label('image[]', 'Gallery Image*', ['class' => 'control-label']) !!}
                                        {!! Form::file('image[]', ['class' => 'form-control', 'placeholder' => '', 'style' => 'border: none;' ]) !!}
                                    </div>
                                </div>
                            </div>
        </div>
    </div>

    <input type="submit" name="Save" class="btn btn-info">
    {!! Form::close() !!}
@stop

@section('javascript')
    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
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