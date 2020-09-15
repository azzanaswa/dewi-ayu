@extends ('pmw3blade.H-F.master')
@section ('content')
   
    <!-- section -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                
                </div>
                <div class="full text_align_right">
                <div class="col-md-12 layout_padding">
                    <div class="full paddding_left_15">
                        <div class="heading_main text_align_left">
                           <h2><span class="theme_color">Panduan</span> PMW</h2>    
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        @php $x = 1 @endphp
                        @foreach($panduans as $panduan)
                        <div id="accordion-7" class="accordion">
                            <div class="card mb-0">
                              <a class="card-header collapsed" data-toggle="collapse" href="#{{$panduan->id}}">
                                <h5 class="card-title text-left">{{$x++}}. {{$panduan->title}}</h5><i class="float-right fa fa-plus"></i>
                              </a>
                              <div id="{{$panduan->id}}" class="card-body collapse" data-parent="#accordion-7">
                                <p>
                                </p>
                                <div class="col-md-12" style="justify-content: center;">
                                  <a href="/profile_pmw/panduan/{{$panduan->file}}" download="{{$panduan->file}}" class="btn btn-info btn-block">Unduh Panduan</a>
                                </div>
                              </div>
                            </div>
                        </div> <hr>
                        @endforeach
                    </div>
                    <div class="full paddding_left_15">
                        
                    </div>
                </div>
            </div>
        </div> <br><br>
    </div> 
    <!-- end section -->
        
    @endsection