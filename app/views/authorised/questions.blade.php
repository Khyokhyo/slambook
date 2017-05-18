@extends('master')

@section('content')

<div class="row">
	<div class="span10 offset1">
		<div class="well">
			<legend>Write on {{ $requests->user_sender->username }}'s Slambook</legend>
			
			@if(!empty($results))
			@foreach($results as $result)
				<div class="well">
			      	<li> {{ $result->questions }}</li><br>
			      	{{ Form::open() }}
			      	<a  href="{{route('write', $result->id)}}" class="btn btn-success" role="button">Answer</a>
			      	{{ Form::close() }}
			    </div>
		 	@endforeach				    
			@endif
			<a  href="{{route('requests')}}" class="btn btn-primary" role="button">Finish</a>
		</div>
		
	</div>

</div>

@stop