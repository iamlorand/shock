<span style="color: #ff0000;">{ERROR}</span>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{TEMPLATES_URL}/css/frontend/update.css">
<form action="{SITE_URL}/user/authorize" method="post" >
<h2>LOGIN</h2>
	<ul class="form">
		<li class="clearfix">
			<label for="username"><i class="glyphicon glyphicon-user"></i>Username:</label>
			<input id="username" type="text" value="{USERNAME}" name="username" placeholder="Username" required>
		</li>
		<li class="clearfix">
			<label for="password"><i class="glyphicon glyphicon-lock"></i>Password:</label>
			<input id="password" type="password" value="{PASSWORD}" name="password" placeholder="Password" required>
		</li>
		<li class="clearfix">
			<label class="empty">&nbsp;</label>
			<input type="submit" onclick="" class="button" value="Log In">
		</li>
		<li class="clearfix">
			<label class="empty">&nbsp;</label>
			<a href="{SITE_URL}/user/forgot-password" style="font-size:smaller">Password Recovery</a>
		</li>
	</ul>
</form>