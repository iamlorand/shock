<style type="text/css">
    #playlists{ width: 80%; margin: auto;}
    #playlists a { color: #ff7700; text-decoration: none; }
    #siteTitle { color: #ff7700; margin-left: 50%;}
</style>

<a href="{SITE_URL}/sound/createplaylist">+ Create a new playlist...</a>
<h3 id="siteTitle">{SITE_TITLE}</h3>
<table id="playlists">
    <thead>
        <tr>
            <th>Playlist Name</th>
            <th>Description</th>
            <th>Date created</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- BEGIN playlist_list -->
            <tr>
                <td class="playlistName"><a href="{SITE_URL}/sound/myplaylist/id/{PLAYLIST_ID}">{PLAYLIST_PLAYLISTNAME}</a></td>
                <td class="description"><a href="{SITE_URL}/sound/myplaylist/id/{PLAYLIST_ID}">{PLAYLIST_DESCRIPTION}</a></td>
                <td class="date"><a href="{SITE_URL}/sound/myplaylist/id/{PLAYLIST_ID}">{PLAYLIST_DATE}</a></td>
                <td>
                    <a href="{SITE_URL}/sound/deleteplaylist/id/{PLAYLIST_ID}" title="Delete" class="glyphicon glyphicon-remove"></a>
                </td>
            </tr>
        <!-- END playlist_list -->
    </tbody>
</table>
