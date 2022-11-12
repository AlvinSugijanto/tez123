<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V14</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/login_page.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

</head>

<body>

<div class="container" id="container">
	<div class="form-container sign-in-container">
	@if ($message = Session::get('error'))
		<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert"></button>	
			<center><strong>{{ $message }}</strong><center>
		</div>
	@endif
		<form action="login" method="post">
         {!! csrf_field() !!} 
			<h1>Sign in</h1>
			<span>or use your account</span>
			<input type="email" placeholder="Email" name="email" />
			<input type="password" placeholder="Password" name="password" />
			<a href="#">Forgot your password?</a>
			<button type="submit">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Elemen Kopi</h1>
				<img class="img-profile rounded-circle" src="../logo_cafe.png" width="250" height="250">

			</div>
		</div>
	</div>
</div>






</body>

</html>