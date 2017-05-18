@extends('master')

@section('content')

<div class="row">
	<div class="span10 offset1">
		<div class="well">
			<legend>Edit Your Profile</legend>
			@if($errors->any())
			<div class="alert alert-error">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</div>
			@endif
			{{ Form::model($details, array('url' => 'editProfile', 'method' => 'PUT', $details->user_id)) }}<br>
			{{ Form::label('username' , 'User name *') }}<br>
			{{ Form::text('username' , Auth::user()->username, array('placeholder' => 'What is your name?', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::label('date_of_birth' , 'Birthday *') }}<br>
			{{ Form::text('date_of_birth', $details->date_of_birth, array('id' => 'datepicker', 'placeholder' => 'Select your Birthday', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::label('city' , 'City') }}<br>
			{{ Form::text('city', $details->city, array('placeholder' => 'Enter the name of your current city', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::label('school' , 'School') }}<br>
			{{ Form::text('school', $details->school, array('placeholder' => 'Enter the name of your school', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::label('college' , 'College') }}<br>
			{{ Form::text('college', $details->college, array('placeholder' => 'Enter the name of your college', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::label('university' , 'University') }}<br>
			{{ Form::text('university', $details->university, array('placeholder' => 'Enter the name of your university', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::submit('Save', array('class' => 'btn btn-success')) }}
			{{ Form::close() }}
		</div>
		
	</div>

</div>

@stop