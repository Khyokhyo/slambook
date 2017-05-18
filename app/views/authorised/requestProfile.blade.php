@extends('master')

@section('content')

<div class="row">
	<div class="span10 offset1">
		<div class="well">
			<legend>{{ $results->user_sender->username }}</legend>

			<div>
			<h3>Email</h3>
			<li>{{ $results->user_sender->email }}</li>
			</div>

			<div>
			<h3>Birthday</h3>
			<li>{{ $results->user_sender->user_details->date_of_birth }}</li>
			</div>

			<div>
			<h3>City</h3>
			<li>{{ $results->user_sender->user_details->city }}</li>
			</div>

			<div>
			<h3>School</h3>
			<li>{{ $results->user_sender->user_details->school }}</li>
			</div>

			<div>
			<h3>College</h3>
			<li>{{ $results->user_sender->user_details->college }}</li>
			</div>

			<div>
			<h3>University</h3>
			<li>{{ $results->user_sender->user_details->university }}</li><br><br>
			</div>

			<div>
			<a  href="{{route('accept', array($results->id, $results->sender_id))}}" class="btn btn-success" role="button">Accept</a>
			<a  href="{{route('requestProfileDelete', $results->id)}}"  class="btn btn-danger" role="button">Ignore</a>
			</div>

		</div>
		
	</div>

</div>

@stop