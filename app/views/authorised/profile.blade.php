@extends('master')

@section('content')

<div class="row">
	<div class="span10 offset1">
		<div class="well">
			<legend>{{ $user['username'] }}</legend>
			@if($errors->any())
			<div class="alert alert-error">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</div>
			@endif

			<div>
			<h3>Email</h3>
			<li>{{ $user['email'] }}</li>
			</div>

			<div>
			<h3>Birthday</h3>
			<li>{{ $details['date_of_birth'] }}</li>
			</div>

			<div>
			<h3>City</h3>
			<li>{{ $details['city'] }}</li>
			</div>

			<div>
			<h3>School</h3>
			<li>{{ $details['school'] }}</li>
			</div>

			<div>
			<h3>College</h3>
			<li>{{ $details['college'] }}</li>
			</div>

			<div>
			<h3>University</h3>
			<li>{{ $details['university'] }}</li><br><br>
			</div>

			<div>
			@if($flag == 0)
				@if($self!=0)
					{{ Form::open(['route' => ['profile', $user->id], 'method' => 'post']) }}
					{{ Form::submit('Send Request', array('name' => 'send', 'class' => 'btn btn-success')) }}
				@endif
		   	@endif
			{{ HTML::link('search', 'Back', array('class' => 'btn btn-danger')) }}
			{{ Form::close() }}
			</div>

		</div>
		
	</div>

</div>

@stop