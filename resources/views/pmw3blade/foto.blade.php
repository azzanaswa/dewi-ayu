@extends('pmw3blade.H-F.master')
@section('content')

 <br/>
  <br/></br>
  <!-- section -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="full text_align_center_img">
                        <img class="img-responsive" src="{{asset('profile_pmw/gallery/'.$galeries->image)}}">
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>

@endsection