<script>
	var SITE_URL = '{SITE_URL}';
</script>

<!-- <script type="text/javascript" src="{TEMPLATES_URL}/js/frontend/user.js"></script> -->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{TEMPLATES_URL}/css/frontend/update.css">
<div class="message_error" style="display:none" id="msgError"></div>
<br/>

	<form id="userRegister" action="" method="post" enctype="multipart/form-data">
	<h2>REGISTER</h2>
		<ul class="form">
			<li class="clearfix">
				<label for="username"><i class="glyphicon glyphicon-user"></i> Username: </label>
				<input id="username" type="text" value="{USERNAME}" name="username" placeholder="Username" required>
			</li>
			<li class="clearfix">
				<label for="password"><i class="glyphicon glyphicon-lock"></i>Password:</label>
				<input type="password" name="password" value="{PASSWORD}" id="password" placeholder="Password" required /> 
			</li>
			<li class="clearfix">
				<label for="password2"><i class="glyphicon glyphicon-lock"></i>Re-type Password:</label>
				<input type="password" name="password2" value="{PASSWORD}" id="password2" placeholder="Re-type password" required />
			</li>
			<li class="clearfix">
				<label for="email"> <i class= "glyphicon glyphicon-envelope"> </i> Email:</label>
				<input id="email" type="text" name="email" value="{EMAIL}" placeholder="exemple@yahoo.com" required />
			</li>
			<li class="clearfix">
				<label for="firstName"><i class="glyphicon glyphicon-user" > </i>First Name:</label>
				<input type="text" name="firstName" value="{FIRSTNAME}" id="firstName" placeholder="First Name" />
			</li>
			<li class="clearfix">
				<label for="lastName"><i class="glyphicon glyphicon-user"> </i>Last Name:</label>
				<input type="text" name="lastName" value="{LASTNAME}" id="lastName" placeholder="Last Name" />
			</li>
			<li class="clearfix">
				<label>Profile Picture:</label>
				<input type="file" name="profilePicture" />
				<input type="hidden" name="url" value="<?php echo htmlentities($_SERVER['REQUEST_URI'])>" />
			</li>
			<li class="clearfix">
				<label class="empty">&nbsp;</label>
				<input type="submit" class="button" value="Register">
			</li>
		</ul>
	</form>
