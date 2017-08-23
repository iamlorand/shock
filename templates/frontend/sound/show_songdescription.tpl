<style type="text/css">
    textarea{ width: 100%; padding: 5px; margin: 2px; }
    .songDescription{ margin: auto; }
    .songDescription td{ padding: 10px; }
    div#audio_player_box{ width:auto; margin:0px auto; text-align: center; }
    div#audio_controls_bar{ background: #333; padding:10px; color:#CCC;}
    #playpausebtn {float: left; margin-right: 10px;}
    #mutebtn {float: right; margin-left: 10px;}
    div#audio_controls_bar button{ color: #481D24; }
    input#seekslider{ width:180px; float: left; }
    input#volumeslider{ width: 80px; float: right; }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
var SITE_URL = "{SITE_URL}";
</script>
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
        var status = $(elem).val();
        var soundId = "{SONG_ID}";
        $.ajax({
            url : siteurl+"/sound/rating",
            type : "POST",
            dataType: "Json",
            data : {status: status, soundId: soundId},
            success : function(response){
                var status = response['status'];
                if (status == "0") {
                    $('#rating').val('0');
                    $('#rating').removeClass('glyphicon glyphicon-heart').addClass('glyphicon glyphicon-heart-empty');
                } else {
                    $('#rating').val('1');
                    $('#rating').removeClass('glyphicon glyphicon-heart-empty').addClass('glyphicon glyphicon-heart');
                }
                $('#ratingCount').text(response['count'] + ' likes');
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


<div class="panel panel-success" style="width: 45%; float: left;">
    <div class="panel-heading">
        <h3 style="text-align: center;">SONG DESCRIPTION</h3>
        
    </div>
    <div id="audio_player_box">
      <audio id="song{SONG_ID}" songId="{SONG_ID}" btnSongId="{SONG_ID}" width="550" height="300">
        <source src="{SITE_URL}/{SONG_FILENAME}" type="audio/mpeg">
      </audio>
      <div id="audio_controls_bar">
        <button id="playpausebtn{SONG_ID}"   btnSongId="{SONG_ID}">Play</button>
        <input id="seekslider{SONG_ID}"      btnSongId="{SONG_ID}" type="range" min="0" max="100" value="0" step="1">
        <span id="curtimetext{SONG_ID}"      btnSongId="{SONG_ID}" >00:00</span> / <span id="durtimetext{SONG_ID}" btnSongId="{SONG_ID}">00:00</span>
        <button id="mutebtn{SONG_ID}"        btnSongId="{SONG_ID}">Mute</button>
        <input id="volumeslider{SONG_ID}"    btnSongId="{SONG_ID}" type="range" min="0" max="100" value="100" step="1">
      </div>
    </div>
    <div class="panel-body">
        <table class="songDescription">
            <tbody>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button class="{SONG_RATING_ICON}" id="rating" value="{SONG_RATING}" onclick="likeUnlike(this)" style="width: 50px; height: auto;"></button>
                        | <b id="ratingCount">{SONG_RATING_COUNT} likes</b>
                        | <b id="ratingCount">{SONG_VIEWCOUNT} views</b>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><img src="{SITE_URL}/{SONG_THUMBNAIL}" style="width: 200px; height: auto;"></td>
                </tr>
                 <tr>
                    <td>Posted by :</td>
                    <td>{SONG_USERNAME}</td>
                </tr>
                <tr>
                    <td>TITLE</td>
                    <td>{SONG_TITLE}</td>
                </tr>
                <tr>
                    <td>DESCRIPTION</td>
                    <td>{SONG_DESCRIPTION}</td>
                </tr>
                <tr>
                    <td>TAGS</td>
                    <td>{SONG_TAGS}</td>
                </tr>
            </tbody>
        </table>      
    </div>
</div>

<div class="box-shadow" style="width: 50%; float: right;">
    <br>
    <hr>
<!-- BEGIN song_comment_list -->

    <li class="clearfix">
        <b>{SONG_COMMENT_USERNAME}:</b>
        <span class="content" id="{SONG_COMMENT_ID}">{SONG_COMMENT_MESSAGE}</span>

        <br>
        <em style="font-size: 10px;">&nbsp; posted · {SONG_COMMENT_DATE}</em>
        <!-- BEGIN song_comment_list_button_logged -->
        <form method="POST" action="" style="float: right;">
            <button name="delete" title="Delete" value="{SONG_COMMENT_ID}">&#10007;</button>
        </form>
        <button id="{SONG_COMMENT_ID}" class="edit" title="Edit" style="float: right;">&#9998;</button>
        <!-- END song_comment_list_button_logged -->
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
        <!-- BEGIN song_reply_list_button_logged -->
        <form method="POST" action="" style="float: right;">
            <button name="delete" title="Delete" value="{SONG_REPLY_ID}">&#10007;</button>
        </form>
        <button id="{SONG_REPLY_ID}" class="edit" title="Edit" style="float: right;">&#9998;</button>
        <!-- END song_reply_list_button_logged -->
    </li>
    <!-- END song_reply_list -->
    
    <hr>
<!-- END song_comment_list -->
    <form class="comment" method="POST" action="">
        <textarea name="text" placeholder="Comment here..." maxlength="500">{SONG_COMMENT_POST}</textarea>
        <button type="submit">Post comment!</button>
    </form>

</div>

<!-- checks if a song was played for at least 35% -->
<script type="text/javascript" src="{SITE_URL}/templates/js/frontend/audioplayer.js"></script>