@extends('master')

@section('content')

<div class="row">
	<div class="span10 offset1">
		<div class="well">
			<h3>Hello {{ ucwords(Auth::user()->username) }}</h3>
			<p>Welcome to your online slambook profile.Now you can get your slambook filled by your friends with a few simple steps.</p>

			<li>Go to 'Set Questions' on menu bar to set your personalised questions</li>
			<li>Go to 'Search' to look for your friends</li>
			<li>Click on 'Send Request' asking them to write on your slambook</li><br>

			<p>Writing on your friend's slambook is simple too.You can write if your friend has sent you a request to write on his/her slambook.</p>

			<li>Go to 'Requests' on menu bar</li>
			<li>Choose a friend</li>
			<li>Click on 'Accept' if you want to write</li>
			<li>Click on 'Answer' to answer a particular question</li>
			<li>Click on 'Finish' when you are done</li><br>

			<p>So what are you waiting for?</p><br>

			<h4>Get Set Go...</h4><br>

			{{ HTML::link('slams', 'View my slambook', array('class' => 'btn btn-primary')) }}
		</div>
	</div>
</div>

@stop