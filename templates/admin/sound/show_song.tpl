<div class="box-shadow" style="width: 500px; float: left;">
    <div class="box_header">
        Song details:
    </div>
    <ul class="form">
        <li class="clearfix">
            <label>Thumbnail:</label>
            <img src="{SITE_URL}/{SONG_THUMBNAIL}" style="width: 200px; height: auto;">
        </li>
        <li class="clearfix">
            <label>File Path:</label>
            <span>{SONG_FILENAME}</span>
        </li>
        <li class="clearfix">
            <label>Title:</label>
            <span>{SONG_TITLE}</span>
        </li>
        <li class="clearfix">
            <label>Description</label>
            <span>{SONG_DESCRIPTION}</span>
        </li>
        <li class="clearfix">
            <label>Tags</label>
            <span>{SONG_TAGS}</span>
        </li>
        <li class="clearfix">
            <label>Filename</label>
            <span>{SONG_FILENAME}</span>
        </li>
        <li class="clearfix">
            <label>&nbsp;</label>
            <button class="button"><a href="{SITE_URL}/admin/sound/update/id/{SONG_ID}/">Go to edit</a></button>
            <button class="button"><a href="{SITE_URL}/admin/sound/list/">Go back</a></button>
        </li>
    </ul>
</div>

<div class="box-shadow" style="width: 50%; float: right;">
    <div class="box_header">
        comment list:
    </div>
    <br>
<!-- BEGIN song_comment_list -->

    <li class="clearfix">
        <b>{SONG_COMMENT_USERNAME}:</b>
        <span class="content">{SONG_COMMENT_MESSAGE}</span>

        <br>
        <em style="font-size: 10px;">&nbsp; posted · {SONG_COMMENT_DATE}</em>
        <form method="POST" action="" style="float: right;">
            <button name="delete" value="{SONG_COMMENT_ID}">Delete</button>
        </form>
        <button id="{SONG_COMMENT_ID}" class="edit" style="float: right;">Edit</button>
    </li>
    <hr>
<!-- END song_comment_list -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(".edit").click(function(){
        var editid = $(this).attr("id");
        $(this).prevAll('.content').contents().unwrap().wrap('<form method="POST" action=""><textarea name="text"/><button name="id" value="'+editid+'" type="submit">Save</button></form>');
        $(this).hide();
    });
});
</script>