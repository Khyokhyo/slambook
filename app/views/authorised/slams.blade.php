@extends('master')

@section('content')

<div class="row">
	<div class="span10 offset1">
		<div class="well">
			<legend>Your slambook</legend>

				<button class="btn btn-warning" onclick="myFunction()">Print</button>

				<h3>{{ $name->username }}</h3><br>
				
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

<script>
	function myFunction() {
		window.print();
	}
</script>

@stop