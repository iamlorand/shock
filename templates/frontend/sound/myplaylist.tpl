<style>
    #playlist{ list-style: none; }
    #playlist li a.songTitle{ color:black; text-decoration: none; }
    #playlist .current-song a span{ color:#ff7700; }
    li a span.title{ color:black; text-decoration: none; float: left; }
    li a span.description{ color:black; text-decoration: none; float: right; }
    a#delete { color:#b30000 !important; text-decoration: none;}
</style>

<a href="{SITE_URL}/sound/allplaylist/">back to playlists...</a>
<br>
<div id="myplaylist_player" style="width: 80%; margin:0 auto;">
    <audio src="" controls id="audioPlayer" style="width: 50%; margin-left: 250px;">
        Sorry, your browser doesn't support html5!
    </audio>
    <ul id="playlist">
    <!-- BEGIN playlist -->
        <li id="{PLAYLIST}" class="playlist">
            <a class="songTitle" href="{SITE_URL}/{FILENAME}">
                <span class="title">{TITLE}</span>
                <span class="description">{DESCRIPTION}</span>
            </a>
            <br>
            <!-- <a id="delete" href="{SITE_URL}/sound/deletefromplaylist/playlistId/{PLAYLIST}/songId/{ID}/" class="glyphicon glyphicon-remove" title="Delete from playlist!" style="float: right;"></a> -->
            <button id="{ID}" class="glyphicon glyphicon-remove" onclick="deleteFromPlaylist(this)" style="float: right;"></button>
        </li>
        <hr>
    <!-- END playlist -->
    </ul>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    function audioPlayer(){
        var currentSong = 0;
        $("#audioPlayer")[0].src = $("#playlist li a.songTitle")[0];
        $("#playlist li a.songTitle.songTitle").click(function(e){
           e.preventDefault(); 
           $("#audioPlayer")[0].src = this;
           $("#audioPlayer")[0].play();
           $("#playlist li").removeClass("current-song");
            currentSong = $(this).parent().index();
            $(this).parent().addClass("current-song");
        });
        
        $("#audioPlayer")[0].addEventListener("ended", function(){
           currentSong++;
            if(currentSong == $("#playlist li a.songTitle").length)
                currentSong = 0;
            $("#playlist li").removeClass("current-song");
            $("#playlist li:eq("+currentSong+")").addClass("current-song");
            $("#audioPlayer")[0].src = $("#playlist li a.songTitle")[currentSong].href;
            $("#audioPlayer")[0].play();
        });
    }
    audioPlayer();
</script>
<script type="text/javascript">
    var siteurl = "{SITE_URL}";
    var playlistId = "{PLAYLIST}";

    function deleteFromPlaylist(elem){
        var soundId = $(elem).attr('id');
        $.ajax({
            url : siteurl+"/sound/deletefromplaylist",
            type : "POST",
            dataType: "Json",
            data : {playlistId: playlistId, soundId: soundId},
            success : function(response){
                if(response['success'] == true){
                    $(elem).parent().next('hr').remove();
                    $(elem).parent().remove();
                } else {
                    alert(response['message']);
                }
            }
        });
    }
</script>