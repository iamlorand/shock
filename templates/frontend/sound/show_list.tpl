<script>
var SITE_URL = "{SITE_URL}";
</script>
<style type="text/css">
    li.playlistElement {
        list-style-type: none;
    }
</style>
<link rel="stylesheet" type="text/css" href="{TEMPLATES_URL}/css/frontend/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <form  class="form-wrapper" action="" method="GET" style="float: left;">
        <input type="search" id="search" name="search" placeholder=" Search here ... " results="5"/>
        <input type="submit" id="submit" value="Submit" />
        <label>  or </label>
        <a href="{SITE_URL}/sound/upload">  <input type="button" id="uploadyour" name="img" value="Upload your own" /> </a>
    </form> <br>
    

<!-- checks if a song was played for at least 35% -->
<script type="text/javascript" src="{SITE_URL}/templates/js/frontend/audioplayer.js"></script>
    <form action="" method="GET" style="float: right;">
        <select name="genre" onchange="this.form.submit()">
            <option value="">Select a genre</option>
            <option value="all">All</option>
            <!-- BEGIN genre_list -->
            <option value="{GENRE}">{GENRE}</option>
            <!-- END genre_list -->
        </select>
    </form>

<div id="userList" class="box-shadow">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Thumbnail</th>
                <th>Song title</th>
                <th>Share</th>
                <th>Preview </th>
                <th>Viewcount</th>
                <th width="230px">Action</th>
            </tr>
        </thead>
        <tbody>
        <!-- BEGIN list_music -->
            <tr>
                
                <td style="width: 50px;"><img src="{SITE_URL}/{THUMBNAIL}" style="width: 100px; height: auto;"></td>
                <td><a href="{SITE_URL}/sound/show_song/id/{ID}">{TITLE}</a></td>
                <td>
                    <table  class="action_table">
                        <tr>
                            <td width="25%" >
                                <a href="https://www.facebook.com/login.php?login_attempt=1&lwv=110"><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i></a>
                                </a>
                            </td>
                            <td width="25%">
                              <a href="https://twitter.com/login/error?redirect_after_login=%2Fsearch-home"><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i></a>
                           </td>
                            <td width="25%" >
                               <a href="https://www.linkedin.com/uas/login"><i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i></a>
                                </a>
                            </td>
                             <td width="25%" >
                               <a href="https://login.yahoo.com/?.src=ym&.intl=us&.lang=en-US&authMechanism=primary&yid=&done=https%3A%2F%2Fmail.yahoo.com%2F&eid=100&add=1"><i class="fa fa-envelope-square fa-2x" aria-hidden="true"></i></a>
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <div id="audio_player_box">
                      <audio id="song{ID}" songId="{ID}" btnSongId="{ID}" width="550" height="300">
                        <source src="{SITE_URL}/{FILENAME}" type="audio/mpeg">
                      </audio>
                      <div id="audio_controls_bar">
                        <button id="playpausebtn{ID}"   btnSongId="{ID}">
                            <i btnSongId="{ID}" class="fa fa-play"></i>
                        </button>
                        <input id="seekslider{ID}"      btnSongId="{ID}" type="range" min="0" max="100" value="0" step="1">
                        <span id="curtimetext{ID}"      btnSongId="{ID}" >00:00</span> / <span id="durtimetext{ID}" btnSongId="{ID}">00:00</span>
                        <button id="mutebtn{ID}"        btnSongId="{ID}"><i btnSongId="{ID}" class="fa fa-volume-up" aria-hidden="true"></i></button>
                        <input id="volumeslider{ID}"    btnSongId="{ID}" type="range" min="0" max="100" value="100" step="1">
                        <button id="stopbtn{ID}"        btnSongId="{ID}"><i btnSongId="{ID}" class="fa fa-stop" aria-hidden="true"></i></button>
                      </div>
                    </div>
                </td>
                <td>{VIEWCOUNT}</td>
                <td>
                    <table  class="action_table">
                        <tr>
                            <!-- BEGIN action_button_logged -->
                            <td>
                                <a href="{SITE_URL}/sound/update/id/{ID}" title="Edit/Update">
                                    <button class="glyphicon glyphicon-pencil"></button>
                                </a>
                            </td>
                            <!-- END action_button_logged -->
                            <td>
                                <button id="{ID}" class="glyphicon glyphicon-pushpin" title="Add to playlist" onclick="addToPlaylist(this)">
                                </button>
                                <ul id="playlistList">
                                    <!-- BEGIN playlist -->
                                        <li id="{PLAYLIST_ID}" songId="{ID}" class="playlistElement" style="display: none; border: solid medium #ff471a; border-radius: 5px;">{PLAYLIST_PLAYLISTNAME}</li>
                                    <!-- END playlist -->
                                </ul>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        <!-- END list_music -->
        </tbody>
    </table>
</div>

{PAGINATION}

<script type="text/javascript">
    var siteurl = "{SITE_URL}";

    function addToPlaylist(elem){
        var soundId = $(elem).attr('id');
        $('li[songId='+soundId+']').show();
        $('li[songId='+soundId+']').click(function(){
            var playlistId = $(this).attr('id');
            $.ajax({
                url : siteurl+"/sound/addtoplaylist",
                type : "POST",
                dataType: "Json",
                data : {playlistId: playlistId, soundId: soundId},
                success : function(response){
                    if(response['success'] == true){
                        $('li[songId='+soundId+']').hide();
                    } else {
                        alert(response['message']);
                    }
                }
            });
        });
    }
</script>
