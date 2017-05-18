@extends('master')

@section('content')

<div class="row">
	<div class="span8 offset1">
		<div class="well">
			<legend>Write on your friend's slam book</legend>
			
			@if(!empty($results))
			@foreach($results as $result)
		        <div class="well">
	       			<a  href="{{route('requestProfile', $result->sender_id)}}">{{ $result->user_sender->username }}</a>
		        </div>
		    @endforeach
			@endif

		</div>
		
	</div>

</div>

@stop