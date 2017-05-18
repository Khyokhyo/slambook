@extends('master')

@section('content')

<div class="row">
	<div class="span10 offset1">
		<div class="well">
			<legend>{{ $name->username }}</legend>
			@if(!empty($answers))			
			@foreach($answers as $answer)
			<div>
				<h3>{{ $answer->question->questions }}</h3>
				<li>{{ $answer->answers }}</li><br><br>
			</div>		       
		    @endforeach
			@endif
			@if(!empty($has))
				<a  href="{{route('editPages', $name->id)}}"  class="btn btn-primary" role="button">Send Edit Request</a>
		   	@endif
		   	<a  href="{{route('deletePages', $name->id)}}"  class="btn btn-danger" role="button">Delete</a>
		</div>
		
	</div>

</div>

@stop