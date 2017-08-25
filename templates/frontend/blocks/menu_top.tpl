<div id="top_menu_button" class="menu_button" onclick="ShowTopMenu()">
	<span></span>
	<span></span>
	<span></span>
</div>

<ul id="top_menu" class="menu_top">
	<li class="{SEL_PAGE_HOME}{SEL_PAGE_ABOUT}{SEL_PAGE_WHO-WE-ARE}">
		<i class="glyphicon glyphicon-home"></i>
		<a href="{SITE_URL}">Home</a>
	</li>
	<li class="{SEL_PAGE_LIST}">
		<i class="glyphicon glyphicon-list-alt"></i>
		<a href="{SITE_URL}/sound/top50/">Top 50</a> 
	</li>
	<li class="{SEL_PAGE_LIST}">
		<i class="glyphicon glyphicon-list-alt"></i>
		<a href="{SITE_URL}/sound/list/">List all songs</a> 
	</li>
	<li class="{SEL_PAGE_LIST}">
		<i class="glyphicon glyphicon-list-alt"></i>
		<a href="{SITE_URL}/sound/allplaylist/">My playlists</a> 
	</li>
	<li class="{SEL_PAGE_UPLOAD}">
		<i class="glyphicon glyphicon-upload"></i>
		<a href="{SITE_URL}/sound/upload/">Upload</a> 
	</li> 
	<!-- BEGIN top_menu_not_logged -->
	<li class="{SEL_USER_LOGIN}">
		<i class="glyphicon glyphicon-log-in"></i>
		<a href="{SITE_URL}/user/login">Log In</a>
	</li>
	<li class="{SEL_USER_REGISTER}">
	<i class="glyphicon glyphicon-registration-mark"></i>
		<a href="{SITE_URL}/user/register">Register</a>
	</li>
	<!-- END top_menu_not_logged -->
	<!-- BEGIN top_menu_logged -->
	<li class="{SEL_USER_ACCOUNT}">
		<i class="glyphicon glyphicon-user"></i>
		<a href="{SITE_URL}/user/account">My Account</a>
	</li>
	<li>
		<i class="glyphicon glyphicon-log-out"></i>
		<a href="{SITE_URL}/user/logout">Log Out</a>
	</li>
	<!-- END top_menu_logged -->
</ul>