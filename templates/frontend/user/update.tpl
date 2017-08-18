<form action="{SITE_URL}/user/account/" method="post" enctype="multipart/form-data">
<input type="hidden" name="userToken" value="{USERTOKEN}">
	<ul class="form">
	<li class="clearfix">
			<label for="image">Select Profile Picture:</label>
			<img src="{SITE_URL}/images/frontend/userAvatar/default.jpg" style="width: 200px; height: auto;">
			<input type="file"  name="image" id="image">
		</li>
	<li class="clearfix">
			<label for="firstName">First Name:</label>
			<input type="text" name="firstName" value="{FIRSTNAME}" id="firstName" />
		</li>
		<li class="clearfix">
			<label for="lastName">Last Name:</label>
			<input type="text" name="lastName" value="{LASTNAME}" id="lastName" />
		</li>
		<li class="clearfix">
			<label>Logged in as:</label>
			<strong>{USERNAME}</strong>
		</li>
		<li class="clearfix">
			<label for="email">Email:</label>
			<input id="email" type="text" name="email" value="{EMAIL}" />
		</li>
		<li class="clearfix">
			<label for="password">Password:</label>
			<input type="password" name="password" value="{PASSWORD}" id="password" />
		</li>
		<li class="clearfix">
			<label for="password2">Re-type Password:</label>
			<input type="password" name="password2" value="{PASSWORD}" id="password2" />
		</li>
		<li class="clearfix">
			<label class="empty">&nbsp;</label>
			<input type="submit" class="button" value="Update" />
		</li>
	</ul>
</form>