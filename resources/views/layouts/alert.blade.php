@if (count($errors)>0)

<div class="row">
	<div class="col-md-12 alert alert-danger container">
		<button type="button" class="close pull-right" data-dismiss="alert">&times;</button>
		<ul style="padding: 15px">
			
			@foreach($errors->all() as $errors)
			<li class="text-dark" style="font-weight: 500;">
				{{$errors}}
			</li>
			@endforeach

		</ul>
	</div>
</div>

@endif

@if(session('info'))
<div class="row" >
	<div class="col-md-12 alert alert-success container">
		<button type="button" class="close pull-right" data-dismiss="alert">&times;</button>
		<i class="fa fa-check"></i>{{session('info')}}	
	</div>
</div>
@endif