@if(Auth::user())

<div class="navbar-collapse collapse">
	<h4>{{ ucwords(Auth::user()->username) }}</h4>
	<ul class="nav navbar-nav navbar-right">
		<li>{{ HTML::link('home', 'Home')}}</li>
		<li>{{ HTML::link('setQuestions', 'Set Questions')}}</li>
		<li>{{ HTML::link('search', 'Search')}}</li>
		<li>{{ HTML::link('requests', 'Requests')}}</li>
		@if($newReq!=0)
		<li>{{ $newReq }}</li>
		@endif
		<li>{{ HTML::link('index', 'Friends')}}</li>
		<li>{{ HTML::link('editProfile', 'Edit Profile')}}</li>
		<li>{{ HTML::link('logout', 'Logout')}}</li>
	</ul>

</div>

@endif