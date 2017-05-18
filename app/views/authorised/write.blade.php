@extends('master')

@section('content')

<div class="row">
	<div class="span10 offset1">
		<div class="well">
			<legend>Answer</legend>
			
			@if($errors->any())
			<div class="alert alert-error">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</div>
			@endif

			@if(empty($has))
			{{ Form::open(array('route' => ['answered',$question->id,$question->user_id], 'method' => 'post')) }}
			<li> {{ $question->questions }}</li><br>
			{{ Form::text('answer', '', array('placeholder' => 'Answer here', 'class' => "col-sm-6")) }}<br><br>
			<button type="submit", class="btn btn-success">Save</button>
			<a  href="{{route('questions', $question->user_id)}}" class="btn btn-danger" role="button">Back</a><br>
			{{ Form::close() }}
			@endif

			@if(!empty($has))
			{{ Form::model($ans, array('route' => ['answerEdit',$question->id,$question->user_id], 'method' => 'put')) }}
			<li> {{ $question->questions }}</li><br>
			{{ Form::text('answer', $ans->answers, array('placeholder' => 'Answer here', 'class' => "col-sm-6")) }}<br><br>
			<button type="submit", class="btn btn-success">Save</button>
			<a  href="{{route('questions', $question->user_id)}}" class="btn btn-danger" role="button">Back</a><br>
			{{ Form::close() }}
			@endif

		</div>
		
	</div>

</div>

@stop