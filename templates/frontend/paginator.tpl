<div class="light">
<div class="paginate1 wrapper">
	
	 
	<ul class="paginate pag2 clearfix"> 
    
		<!-- BEGIN first -->
			<li>
			<a   href="{FIRST_LINK}" class="inactive">First</a>
			</li>
		<!-- END first -->
		<!-- BEGIN pages -->
			<!-- BEGIN current_page -->
				<li  >
				 <a href="" class="active"> <p>{PAGE_NUMBER}</p> </a>
				</li>
			<!-- END current_page -->
			<!-- BEGIN other_page -->
				<li >
					<a  href="{PAGE_LINK}">{PAGE_NUMBER}</a>
				</li >
			<!-- END other_page -->
		<!-- END pages -->
		<!-- BEGIN last -->
			<li >
			<a   href="{LAST_LINK}">Last</a>
			</li>
		<!-- END last -->
		 
	

	</ul>
	<span>
		{TOTAL_RECORDS} record(s) | 
		{TOTAL_PAGES} page(s)
	</span>
</div>
</div>