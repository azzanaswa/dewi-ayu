@extends('pmw3blade.H-F.master')
@section('content')

    <!-- section -->
   <div class="section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="full">
                        <div class="heading_main text_align_center">
                           <h2><span class="theme_color"></span>Galeri dan Dokumentasi</h2>    
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($galeries as $gallery)
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="full news_blog">
                       <img class="img-responsive" src="{{asset('profile_pmw/gallery/'.$gallery->image)}}" alt="foto" />
                       <div class="overlay"><a class="main_bt transparent" href="{{route('galeri.show', $gallery->slug)}}">View</a></div>
                       <div class="blog_details" style="width: 100%;">
                         <h3>{{date('Y', strtotime($gallery->created_at))}}</h3>
                         <p>{{$gallery->title}}</p>
                       </div>
                    </div>
                </div>
                @endforeach
             </div>
        </div>
    </div>
                <div class="col-lg-8 mx-auto my-5"> 
 
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {{ $error }} <br/>
                    @endforeach
                </div>
                @endif
 
            </div>
            </div>
        </div>
    
    <!-- end section -->
   
    @endsection