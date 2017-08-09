

<div id="adminList" class="box-shadow">
	<table class="big_table" frame="box" rules="all">
		<thead>
			<tr>
				<th style="text-align: center; width: 20px;"><span>#</span></th>
				<th><span>Title</span></th>
				<th><span>Filename</span></th>
				<th><span>ViewCount</span></th>
				
			</tr>
		</thead>
		<tbody>
		<!-- BEGIN list_music -->
			<tr>
				<td style="text-align: center;">{TITLE}</td>
				<td><a href="{SITE_URL}/sound/show_music/id/{ID}/">{FILENAME}</td>
				<td>{VIEWCOUNT}</td>
				
			</tr>

		<!-- END list_music -->
		</tbody>
	</table>
</div>
{PAGINATION}