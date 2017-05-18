@extends('master')

@section('content')

<div class="row">
	<div class="span8 offset1">
		<div class="well">
				
			@if(!empty($answers))			
			@foreach($answers as $answer)
			<div>
				<h4>{{ $answer->question->questions }}</h4>
				<li>{{ $answer->answers }}</li><br><br>
			</div>		       
		    @endforeach
			@endif
			
		   	@if(!empty($prev))
		   	<a  href="{{route('postSlams', $prev)}}" class="btn btn-info" role="button">Prev</a>
		   	@endif

		   	@if(!empty($next))
		   	<a  href="{{route('postSlams', $next)}}" class="btn btn-primary" role="button">Next</a><br>
		   	@endif

		</div>
		
	</div>

</div>

@stop