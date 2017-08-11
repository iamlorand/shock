<style type="text/css">
    textarea{
        width: 100%;
        padding: 5px;
        margin: 2px;
    }
</style>
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
<script type="text/javascript">
    var siteurl = "{SITE_URL}";

    function likeUnlike(elem){
        var status = $(elem).text();
        var id = $(elem).attr('id');
        var soundId = "{SONG_ID}";
        $.ajax({
            url : siteurl+"/sound/test",
            type : "POST",
            dataType: "Json",
            data : {status: status, soundId: soundId},
            success : function(response){
                var status = response['status'];
                if (status == "Liked") {
                    $('#'+id).text('Like');
                    $('#'+id).removeClass('glyphicon glyphicon-heart').addClass('glyphicon glyphicon-heart-empty');
                } else {
                    $('#'+id).text('Liked');
                    $('#'+id).removeClass('glyphicon glyphicon-heart-empty').addClass('glyphicon glyphicon-heart');
                }
            }
        });
    }
</script>
<script>

function reply(id)
{
    $("div #t1_"+id).show();
}

</script>
<div>
    <ul class="form">
        <li class="clearfix">
            <label>Album Thumbnail:</label>
            <img src="{SITE_URL}/{SONG_THUMBNAIL}" style="width: 200px; height: auto;">
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
    </ul>
</div>

<button class="{SONG_RATING_ICON}" id="test" onclick="likeUnlike(this)">{SONG_RATING}</button>

<div class="box-shadow" style="width: 50%; float: right;">
    <br>
    <hr>
<!-- BEGIN song_comment_list -->

    <li class="clearfix">
        <b>{SONG_COMMENT_USERNAME}:</b>
        <span class="content" id="{SONG_COMMENT_ID}">{SONG_COMMENT_MESSAGE}</span>

        <br>
        <em style="font-size: 10px;">&nbsp; posted · {SONG_COMMENT_DATE}</em>
        <form method="POST" action="" style="float: right;">
            <button name="delete" title="Delete" value="{SONG_COMMENT_ID}">&#10007;</button>
        </form>
        <button id="{SONG_COMMENT_ID}" class="edit" title="Edit" style="float: right;">&#9998;</button>
        <button id="{SONG_COMMENT_ID}" class="reply_{SONG_COMMENT_ID}" onclick= "reply({SONG_COMMENT_ID})" title="Reply" style="float: right;">&#8476;</button>
    </li>

    <div id="t1_{SONG_COMMENT_ID}" style="display:none;">
        <form id="reply_{SONG_COMMENT_ID}" method="POST" action="" >
            <textarea name="text" placeholder="Comment here..." maxlength="500"></textarea>
            <input type="hidden" name="parentId" value="{SONG_COMMENT_ID}">
            <button type="submit">Post reply!</button>
        </form>
    </div>

    <!-- BEGIN song_reply_list -->

    <li class="clearfix" style="margin-left: 5px;">
        <b>⇒{SONG_REPLY_USERNAME}:</b>
        <span class="content">{SONG_REPLY_MESSAGE}</span>

        <br>
        <em style="font-size: 10px;">&nbsp; posted · {SONG_REPLY_DATE}</em>
        <form method="POST" action="" style="float: right;">
            <button name="delete" title="Delete" value="{SONG_REPLY_ID}">&#10007;</button>
        </form>
        <button id="{SONG_REPLY_ID}" class="edit" title="Edit" style="float: right;">&#9998;</button>
    </li>
    <!-- END song_reply_list -->
    
    <hr>
<!-- END song_comment_list -->
    <form class="comment" method="POST" action="">
        <textarea name="text" placeholder="Comment here..." maxlength="500"></textarea>
        <button type="submit">Post comment!</button>
    </form>

</div>
