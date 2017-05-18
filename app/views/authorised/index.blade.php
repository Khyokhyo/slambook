@extends('master')

@section('content')

<div class="row">
	<div class="span10 offset1">
		<div class="well">
			@if(!empty($names))
			<legend>Friends who wrote on your slambook</legend>
			@foreach($names as $name)
		       	<div class="well">
		       		<li><a  href="{{route('pages', $name->receiver_id)}}">{{ $name->user_receiver->username }}</a><br></li>
		   		</div>
		    @endforeach
			@endif
		</div>
	</div>
</div>

@stop