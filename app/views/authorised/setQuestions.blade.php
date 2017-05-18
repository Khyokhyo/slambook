@extends('master')

@section('content')

<div class="row">
	<div class="span10 offset1">
		<div class="well">
			<legend>Set Your Questions</legend>
			{{ Form::open(array()) }}
			@if($errors->any())
			<div class="alert alert-error">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</div>
			@endif
			{{ Form::text('question', '', array('placeholder' => 'Add a question here', 'class' => "col-sm-6")) }}<br><br>
			{{ Form::submit('Add New', array('class' => 'btn btn-primary')) }}<br><br>
			{{ Form::close() }}

			@if(!empty($results))
			@foreach($results as $result)
				<div class="well">
			        <li>
			            {{ $result->questions }}<br><br>
			            {{ Form::open(['route' => ['set-questions', $result->id], 'method' => 'delete']) }}
							<button type="submit", class="btn btn-danger">Delete</button>
						{{ Form::close() }}
			        </li>
			    </div>
			    @endforeach		
			@endif
		</div>
		
	</div>

</div>

@stop