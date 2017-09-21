<style>
    #playlist{ list-style: none; }
    #playlist li a.songTitle{ color:black; text-decoration: none; }
    #playlist .current-song a span{ color:#ff7700; }
    li a span.title{ color:black; text-decoration: none; float: left; }
    li a span.description{ color:black; text-decoration: none; float: right; }
    a#delete { color:#b30000 !important; text-decoration: none;}
</style>
<link rel="stylesheet" type="text/css" href="{TEMPLATES_URL}/css/frontend/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<a href="{SITE_URL}/sound/allplaylist/">back to playlists...</a>
<br>
<button  style="float:left;" id="randomSong" value="0" onclick="shuffleSong(this)"><i class="fa fa-random" aria-hidden="true"></i></button>
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
    var shuffle = 0;
    var rand = null;

    //random number between song count and 0 for shuffle
    var songCount = $("#playlist li a.songTitle").length-1;

    function shuffleSong(elem) {
        shuffle = $(elem).val();
        shuffle = -1*shuffle+1;
        $(elem).val(shuffle);
        if(shuffle == 1) {
        $(elem).children().attr("class","fa fa-random");
        $(elem).css("color","#ff7700");
        } else {
            $(elem).children().attr("class","fa fa-random");
            $(elem).css("color","");
        }
        
    }

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
            if (shuffle == 1) {
                if (rand != null) {
                    var previous = rand;
                    while (previous == rand) {
                        rand = 1 + Math.floor(Math.random() * songCount);
                    }
                } else {
                     $(this).children().attr("class","fa fa-pause");
                    rand = 1 + Math.floor(Math.random() * songCount);
                }
                currentSong = rand;
            } else {
                currentSong++;
            }
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