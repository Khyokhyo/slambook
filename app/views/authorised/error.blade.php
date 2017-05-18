@extends('master')

@section('content')

<div class="row">
	<div class="span10 offset1">
		<div class="well">
			
			<legend>Your slambook</legend>

			<h4>No one has written on your slambook yet !</h4><br>
			{{ HTML::link('home', 'Back', array('class' => 'btn btn-danger')) }}
			   	
		</div>
		
	</div>

</div>

@stop