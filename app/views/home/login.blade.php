@extends('master')

@section('content')

<div class="container">
<div class="jumbletron">
<div class="col-md-4"></div>
<div class="col-md-4"><br><br>
<div class="row">
	<div class="span4 offset1">
		<div class="well">
			<legend>Please Login</legend><br>
			{{ Form::open(array('url' => 'login')) }}
			@if($errors->any())
			<div class="alert alert-error">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</div>
			@endif
			<div>
				{{ Form::text('email', '', array('placeholder' => 'Email', 'class' => "col-sm-11")) }}<br><br>
				{{ Form::password('password', array('placeholder' => 'Password', 'class' => "col-sm-11")) }}<br><br><br>
				{{ Form::submit('Login', array('class' => 'btn btn-success')) }}
				{{ HTML::link('register', 'Register', array('class' => 'btn btn-primary')) }}
				{{ Form::close() }}
			</div>
						
		</div>
	</div>
</div>

</div>
		
</div>

</div>

@stop