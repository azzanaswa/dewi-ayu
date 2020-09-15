@extends('pmw3blade.H-F.master')
@section('content')
    <br/>
	<br/></br>
<div class="container">
<div class="main">
<div class="container">

<div class="row">
<div class="col-md-4">
<h1>PENGUMUMAN</h1>
</div>
</div>
@foreach ($pengumumans ->all() as $pengumuman)

<div class="col-md-20 col-sm-6 col-xs-12">

<h1>
<b><a href="{{route('pengumuman.show', $pengumuman->slug)}}" class="title">{{ $pengumuman->title }}</a></b>
</h1>
<h6> Organized by : admin</h6>
<h6>{{ $pengumuman->created_at }}</h6>
</div>
 @endforeach
 </div>
 </div>
 </div>
 @endsection