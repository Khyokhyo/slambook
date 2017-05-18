<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Slambook</title>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	{{ HTML::script('js/jquery.js') }}
	{{ HTML::script('js/bootstrap.js') }}

	{{ HTML::style('css/bootstrap.css') }}
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/custom.css') }}

</head>
<body>
	<div class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container-fluid">
			<h1>Slambook</h1>
			@if(Auth::user())
			
			@include('authorised.layout')

			@endif
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
	</div>		
		<br><br>
	<div class="container">
	@yield('content')	
	</div>
	
					

<footer class="row">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	   	<script>
		  $(function() {
		    $( "#datepicker" ).datepicker();
		  });
		</script>
</footer>
</body>
</html>