<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="top_menu_button" class="menu_button" onclick="ShowTopMenu()">
	<span></span>
	<span></span>
	<span></span>
</div>

<ul id="top_menu" class="menu_top">
	<!-- BEGIN top_menu_not_logged -->
	<li class="{SEL_SOUND_LIST}">
		<a href="{SITE_URL}/sound/list">
		<i class="fa fa-home"></i>Home</a>
		
	</li>
	
	<li class="{SEL_SOUND_TOP50}">
		<a href="{SITE_URL}/sound/top50/">
		<i class="fa fa-thumbs-up"></i>Top 50</a> 
	</li>

	<li class="{SEL_SOUND_UPLOAD}">
		<a href="{SITE_URL}/sound/upload">
		<i class="fa fa-upload"></i>Upload</a> 
	</li> 

	<li class="{SEL_USER_LOGIN}">
		<a href="{SITE_URL}/user/login">
		<i class="fa fa-sign-in""></i>Log In</a>
	</li>

	<li class="{SEL_USER_REGISTER}">
		<a href="{SITE_URL}/user/register">
		<i class="fa fa-registered"></i>Register</a>
	</li>

	<!-- END top_menu_not_logged -->
	<!-- BEGIN top_menu_logged -->
	<li class="{SEL_SOUND_LIST}">
		<a href="{SITE_URL}/sound/list">
		<i class="fa fa-home"></i>Home</a>
	</li>

	<li class="{SEL_SOUND_TOP50}">
		<a href="{SITE_URL}/sound/top50">
		<i class="fa fa-thumbs-o-up"></i>Top 50</a> 
	</li>

	<li class="{SEL_SOUND_ALLPLAYLIST}">
		<a href="{SITE_URL}/sound/allplaylist">
		<i class="fa fa-bars"></i>My playlists</a> 
	</li>
	
	<li class="{SEL_SOUND_UPLOAD}">
		<a href="{SITE_URL}/sound/upload">
		<i class="fa fa-upload"></i>Upload</a> 
	</li> 

	<li class="{SEL_USER_ACCOUNT}">
		<a href="{SITE_URL}/user/account">
		<i class="fa fa-user-circle-o"></i>My Account</a>
	</li>

	<li>
		<a href="{SITE_URL}/user/logout">
		<i class="fa fa-sign-out""></i>Log Out</a>
	</li>
	<!-- END top_menu_logged -->
</ul>