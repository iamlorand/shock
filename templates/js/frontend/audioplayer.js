var playbtn, seekslider, curtimetext, durtimetext, mutebtn, volumeslider, listened = 0, viewed = false, startTime = 0, totalTime = 0;

var song = [];
var playbtn = [];
var seekslider = [];
var curtimetext = [];
var durtimetext = [];
var mutebtn = [];
var volumeslider = [];

var siteurl = SITE_URL;

var previousSong;

function assignPlayerEvents(id) {

    song[id] = document.getElementById("song"+id);
    playbtn[id] = document.getElementById("playpausebtn"+id);
    seekslider[id] = document.getElementById("seekslider"+id);
    curtimetext[id] = document.getElementById("curtimetext"+id);
    durtimetext[id] = document.getElementById("durtimetext"+id);
    mutebtn[id] = document.getElementById("mutebtn"+id);
    volumeslider[id] = document.getElementById("volumeslider"+id);

    playbtn[id].addEventListener("click",playPause,false);
    seekslider[id].addEventListener("change",songSeek,false);
    song[id].addEventListener("timeupdate",seektimeupdate,false);
    mutebtn[id].addEventListener("click",songMute,false);
    volumeslider[id].addEventListener("change",setvolume,false);

}

//stops and sends the listened time to analize
window.onbeforeunload = function() {
    $(document).ready(function(){
            var status = ($(playbtn).children().attr('class'));
            if(status == "fa fa-pause"){
                playbtn.click();
            }
    });
}
var audioList;
var songList = [];
$(document).ready(function(){
    audioList = $("[songId]");
    var songList = [];
    $.each(audioList, function(){
        var currentSong = $(this);
        var songId = currentSong.attr('songId');
        assignPlayerEvents(songId);
        songList[songId] = $(this);
    });
});

//plays or pauses the song
function playPause(e){
    
    songId = $(e.target).attr('btnSongId');
    if (isNaN(songId)) {
        alert("!");
        return;
    }

    var song = document.getElementById("song"+songId);
    playbtn = document.getElementById("playpausebtn"+songId);
    if(song.paused){
        if(typeof previousSong !== "undefined")
        {
            previousSong.pause();
            $(previousPlayBtn).children().attr("class","fa fa-play");
            totalTime += previousSong.currentTime - startTime;
            listened = (totalTime / previousSong.duration) * 100;
            if((listened > 5) && (viewed == false)) {
                viewed = true;
                var requestSettings = {
                            'data' : {'viewed': viewed, 'soundId': previousSongId},
                            'method' : 'POST'
                        };
                $.ajax(siteurl+"/sound/viewed", requestSettings).done(function(response){
                    var receivedData = $.parseJSON(response);
                    var voteSuccess = receivedData['success']
                    var voteValue = receivedData['data']['voteValue'];
                    if (voteSuccess == true) {
                        $('#voteValue').text(voteValue);
                    }
                });
                viewed = false;
            }
        }
        song.play();
        previousSong = document.getElementById("song"+songId);
        previousPlayBtn = document.getElementById("playpausebtn"+songId);
        previousSongId = songId;

        // playbtn.innerHTML = "Pause";
        $(this).children().attr("class","fa fa-pause");
        startTime = song.currentTime;
    } else {
        song.pause();
        // playbtn.innerHTML = "Play";
        $(this).children().attr("class","fa fa-play");
        totalTime += song.currentTime - startTime;
        listened = (totalTime / song.duration) * 100;
        if((listened > 5) && (viewed == false)) {
            viewed = true;
            var requestSettings = {
                        'data' : {'viewed': viewed, 'soundId': songId},
                        'method' : 'POST'
                    };
            $.ajax(siteurl+"/sound/viewed", requestSettings).done(function(response){
                var receivedData = $.parseJSON(response);
                var voteSuccess = receivedData['success']
                var voteValue = receivedData['data']['voteValue'];
                if (voteSuccess == true) {
                    $('#voteValue').text(voteValue);
                }
            });
            viewed = false;
        }
    }
}

//jumps to whereever is clicked on the songs seekslider
function songSeek(e){
    songId = $(e.target).attr('btnSongId');

    var seekslider = document.getElementById("seekslider"+songId);

    if(!song[songId].paused){
        song[songId].pause();
        totalTime += song[songId].currentTime - startTime;
        var seekto = song[songId].duration * (seekslider.value / 100);
        song[songId].currentTime = seekto;
        song[songId].play();
        startTime = song[songId].currentTime;
    } else {
        var seekto = song[songId].duration * (seekslider.value / 100);
        song[songId].currentTime = seekto;
    }
}

//updates the time when the music is playing
function seektimeupdate(e){
    songId = $(e.target).attr('btnSongId');

    curtimetext = document.getElementById("curtimetext"+songId);
    durtimetext = document.getElementById("durtimetext"+songId);

    var nt = song[songId].currentTime * (100 / song[songId].duration);
    seekslider[songId].value = nt;
    var curmins = Math.floor(song[songId].currentTime / 60);
    var cursecs = Math.floor(song[songId].currentTime - curmins * 60);
    var durmins = Math.floor(song[songId].duration / 60);
    var dursecs = Math.floor(song[songId].duration - durmins * 60);
    if(cursecs < 10){ cursecs = "0"+cursecs; }
    if(dursecs < 10){ dursecs = "0"+dursecs; }
    if(curmins < 10){ curmins = "0"+curmins; }
    if(durmins < 10){ durmins = "0"+durmins; }
    curtimetext.innerHTML = curmins+":"+cursecs;
    durtimetext.innerHTML = durmins+":"+dursecs;
}

//mutes the song
function songMute(e){
    songId = $(e.target).attr('btnSongId');
    var song = document.getElementById("song"+songId);
    mutebtn = document.getElementById("mutebtn"+songId);

    if(song.muted){
        song.muted = false;
        // mutebtn.innerHTML = "Mute";
        $(this).children().attr("class","fa fa-volume-up");
    } else {
        song.muted = true;
        // mutebtn.innerHTML = "Unmute";
        $(this).children().attr("class","fa fa-volume-off");

    }
}

//sets the volume by clicking the volume seekbar
function setvolume(e){
    songId = $(e.target).attr('btnSongId');

    $(song[songId]).prop("volume", volumeslider[songId].value / 100);
}