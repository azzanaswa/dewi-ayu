@extends('pmw3blade.H-F.master')
@section('content')
    <br/>
	<br/></br>
	<!-- section -->
    <div class="section">
        <div class="container">
            <div class="row">
                
                </div>
                <div class="col-md-12 layout_padding">
                    <div class="full paddding_left_15">
                        <div class="heading_main text_align_right">
						   <h2> Pengumuman </h2>
                        <div class="full paddding_left_15">

                            <p> <strong>{{$pengumumans->title}}</strong> </p>
                            <p> {!!$pengumumans->content!!} </p>
                            
                            <br>    
                            <a href="/profile_pmw/pengumuman/file/{{$pengumumans->file}}" download="{{$pengumumans->file}}" class="btn btn-info btn-block">Unduh Pengumuman</a>

                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- end section -->
 		<br><br>
@endsection
	
	