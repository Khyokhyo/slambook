@extends('master')

@section('content')

<div class="jumbletron">
	<div class="row span">
	<div class="col-sm-10">
		<div class="well">
			<legend>Please Register</legend>
			{{ Form::open(array('url' => 'register')) }}
			@if($errors->any())
			<div class="alert alert-error">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</div>
			@endif
			{{ Form::label('name' , 'User name *') }}<br>
			{{ Form::text('username', '', array('placeholder' => 'What is your name?', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::label('name' , 'Email id *') }}<br>
			{{ Form::text('email', '', array('placeholder' => 'You will use this when you log in', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::label('name' , 'Password *') }}<br>
			{{ Form::password('password', array('placeholder' => 'Enter a combination of numbers, letters and punctuation marks', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::label('name' , 'Birthday *') }}<br>
			{{ Form::text('date_of_birth', '', array('id' => 'datepicker', 'placeholder' => 'Select your Birthday', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::label('name' , 'City') }}<br>
			{{ Form::text('city', '', array('placeholder' => 'Enter the name of your current city', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::label('name' , 'School') }}<br>
			{{ Form::text('school', '', array('placeholder' => 'Enter the name of your school', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::label('name' , 'College') }}<br>
			{{ Form::text('college', '', array('placeholder' => 'Enter the name of your college', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::label('name' , 'University') }}<br>
			{{ Form::text('university', '', array('placeholder' => 'Enter the name of your university', 'class' => "col-sm-9")) }}<br><br>
			{{ Form::submit('Register', array('class' => 'btn btn-primary')) }}
			{{ HTML::link('/', 'Cancel', array('class' => 'btn btn-danger')) }}
			{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@stop