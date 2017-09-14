<?php

class Sound_View extends View
{
    public function __construct($tpl)
    {
        $this->tpl = $tpl;
        $this->settings = Zend_Registry::get('settings');
        $this->session = Zend_Registry::get('session');
    }
    #use this function to upload a file
    public function upload($template = '',$genreList)
    {
        if ($template != '')
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'sound/' . $this->template . '.tpl');
            $this->tpl->setBlock('tpl_main','genre_list','genre_list_block');
            foreach ($genreList as $genre) {
                foreach ($genre as $key => $value) {
                    $this->tpl->setVar(strtoupper($key),$value); 
                }
                $this->tpl->parse('genre_list_block','genre_list',true);
            }
        }  
    }
    #use this function to create a new playlist
    public function createPlaylist($template = '')
    {
        if ($template != '')
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'sound/' . $this->template . '.tpl');
        }  
    }
    #displays all playlists of the logged user
    public function allMyPlaylists($template='', $list)
    {
        if ($template != '') $this->template=$template;
        $this->tpl->setFile('tpl_main','sound/'.$this->template.'.tpl');
        $this->tpl->setBlock('tpl_main','playlist_list','playlist_list_block');

        foreach ($list as $data) {
            foreach ($data as $key => $value) {
                $this->tpl->setVar('PLAYLIST_' . strtoupper($key),$value); 
            }
            $this->tpl->parse('playlist_list_block','playlist_list',true);
        }
    }
    #displays your requested playlist
    public function myPlaylist($template='', $list)
    {
        if ($template != '') $this->template=$template;
        $this->tpl->setFile('tpl_main','sound/'.$this->template.'.tpl');
        $this->tpl->setBlock('tpl_main','playlist','playlist_block');

        foreach ($list as $music) {
            foreach ($music as $key => $value) {
                $this->tpl->setVar(strtoupper($key),$value); 
            }
            $this->tpl->parse('playlist_block','playlist',true);
        }
    }
    #use this function to display genres
    public function displayGenres($template = '', $genreList)
    {
        if ($template != '')
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'sound/' . $this->template . '.tpl');
            $this->tpl->setBlock('tpl_main','genre_list','genre_list_block');
            foreach ($genreList as $genre) {
                foreach ($genre as $key => $value) {
                    $this->tpl->setVar(strtoupper($key),$value); 
                }
                $this->tpl->parse('genre_list_block','genre_list',true);
            }
        }  
    }

    public function showMusic($template='', $list, $page = 1, $playlistList = '')
    {
        if ($template != '') $this->template=$template;
        $this->tpl->setFile('tpl_main','sound/'.$this->template.'.tpl');
        $this->tpl->setBlock('tpl_main','list_music','list_music_block');
        $this->tpl->setBlock('list_music','playlist','playlist_block');
        $this->tpl->setBlock('list_music','action_button_logged','action_button_logged_block');
        $this->tpl->paginator($list['pages']);
        $this->tpl->setVar('PAGE',$page);

        foreach ($list['data'] as $list => $music) {
            //parsing the buttons on the replys for the logged users 
            if (isset($this->session->user->id)) {
                $this->tpl->parse('action_button_logged_block', '');
                if ($music['userId'] == $this->session->user->id) {
                   $this->tpl->parse('action_button_logged_block', 'action_button_logged', TRUE); 
                }
            }
            foreach ($music as $key => $value) {
                if ($key == 'thumbnail' && $value == '') {
                    $this->tpl->setVar(strtoupper($key), '{SITE_URL}images/frontend/vinyl_default.jpg');
                } else {
                    $this->tpl->setVar(strtoupper($key),$value); 
                }
            }
            if ($playlistList != '') {
                $this->tpl->parse('playlist_block','');
                foreach ($playlistList as $play) {
                    foreach ($play as $playlistKey => $playlistValue) {
                        $this->tpl->setVar('PLAYLIST_' . strtoupper($playlistKey),$playlistValue);
                    }
                    $this->tpl->parse('playlist_block','playlist',true);
                }
            }
            $this->tpl->parse('list_music_block','list_music',true);
        }
    }

    #with this function you can edit an record(song) by id
    public function showSongEdit($template = '', $music)
    {
        if (!empty($template))
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'sound/' . $this->template . '.tpl');
            foreach ($music as $key => $value) {
                $this->tpl->setVar('SONG_'.strtoupper($key), $value);
            }
        }
    }

    
    //top 50 order by viewCount
    public function top50($template='', $list, $playlistList = ''){
               if ($template != '') $this->template=$template;
        $this->tpl->setFile('tpl_main','sound/'.$this->template.'.tpl');
        $this->tpl->setBlock('tpl_main','list_music','list_music_block');
        $this->tpl->setBlock('list_music','playlist','playlist_block');
        $this->tpl->setBlock('list_music','action_button_logged','action_button_logged_block');
       
     foreach ($list as $listTop => $music) {
            //parsing the buttons on the replys for the logged users 
            if (isset($this->session->user->id)) {
                $this->tpl->parse('action_button_logged_block', '');
                if ($music['userId'] == $this->session->user->id) {
                   $this->tpl->parse('action_button_logged_block', 'action_button_logged', TRUE); 
                }
            }
            foreach ($music as $key => $value) {
                if ($key == 'thumbnail' && $value == '') {
                    $this->tpl->setVar(strtoupper($key), '{SITE_URL}images/frontend/vinyl_default.jpg');
                } else {
                    $this->tpl->setVar(strtoupper($key),$value); 
                }
            }
            if ($playlistList != '') {
                $this->tpl->parse('playlist_block','');
                foreach ($playlistList as $play) {
                    foreach ($play as $playlistKey => $playlistValue) {
                        $this->tpl->setVar('PLAYLIST_' . strtoupper($playlistKey),$playlistValue);
                    }
                    $this->tpl->parse('playlist_block','playlist',true);
                }
            }
            $this->tpl->parse('list_music_block','list_music',true);
        }
    }


    #confirm deleting a record(song) by id
    public function showDeleteConfirmation($template = '', $music)
    {
        if (!empty($template))
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'sound/' . $this->template . '.tpl');
            foreach ($music as $key => $value) {
                $this->tpl->setVar('SONG_'.strtoupper($key), $value);
            }
        }
    }
     
    #displays the details of a song
    public function showSongById($template = '', $music, $commentList, $rating = '', $ratingCount = '')
    {
        if ($template != '')
        {
            $this->template=$template;
            $this->tpl->setFile('tpl_main','sound/'.$this->template.'.tpl');
            $this->tpl->setBlock('tpl_main', 'song_comment_list', 'song_comment_list_block');
            $this->tpl->setBlock('song_comment_list', 'song_reply_list', 'song_reply_list_block');
            $this->tpl->setBlock('song_comment_list', 'song_comment_list_button_logged', 'song_comment_list_button_logged_block');
            $this->tpl->setBlock('song_reply_list', 'song_reply_list_button_logged', 'song_reply_list_button_logged_block');
            //redirects and autocompletes comment after login
            if(isset($_SESSION['message']) && !isset($_SESSION['parentId']))
            {
                $this->tpl->setVar('SONG_COMMENT_POST', $_SESSION['message']);
                unset($_SESSION['message']);
            }

            //parsing the rating of the song
            if ($ratingCount != '') {
                $this->tpl->setVar('SONG_RATING_COUNT', $ratingCount);
            } else {
                $this->tpl->setVar('SONG_RATING_COUNT', 0);
            }

            if ($rating != '') {
                if($rating['rating'] == 1) {
                    $this->tpl->setVar('SONG_RATING', $rating['rating']); 
                    $this->tpl->setVar('SONG_RATING_ICON', 'glyphicon glyphicon-heart'); 

                } else {
                    $this->tpl->setVar('SONG_RATING', $rating['rating']);
                    $this->tpl->setVar('SONG_RATING_ICON', 'glyphicon glyphicon-heart-empty');
                }
            } else {
                $this->tpl->setVar('SONG_RATING', 0);
                $this->tpl->setVar('SONG_RATING_ICON', 'glyphicon glyphicon-heart-empty');
            }
            //parsing the song details

            foreach ($music as $key => $value) {
                if ($key == 'thumbnail' && $value == '') {
                    $this->tpl->setVar('SONG_'.strtoupper($key), '{SITE_URL}images/frontend/vinyl_default.jpg'); 
                } elseif ($key == 'tags' && $value != '') {
                    $this->tpl->setVar('SONG_'.strtoupper($key), '#' . $value);
                } else {
                    $this->tpl->setVar('SONG_'.strtoupper($key),$value);
                }
            }

            //parsing the comments and the buttons for the logged user
            foreach ($commentList as $comment) {
                foreach ($comment as $replyKey => $replyValue) {
                    if ($replyKey != 'replies') {
                        $this->tpl->setVar('SONG_COMMENT_'.strtoupper($replyKey), $replyValue);
                        //parsing the buttons on the comments for the logged users
                        if (isset($this->session->user->id)) {
                            $this->tpl->parse('song_comment_list_button_logged_block', '');
                            if ($comment['userId'] == $this->session->user->id) {
                               $this->tpl->parse('song_comment_list_button_logged_block', 'song_comment_list_button_logged', TRUE);
                            }
                        }
                    } 
                    else {
                        foreach ($replyValue as $reply) {
                            foreach ($reply as $key => $value) {
                                $this->tpl->setVar('SONG_REPLY_'.strtoupper($key), $value);
                                //parsing the buttons on the replys for the logged users 
                                if (isset($this->session->user->id)) {
                                    $this->tpl->parse('song_reply_list_button_logged_block', '');
                                    if ($reply['userId'] == $this->session->user->id) {
                                       $this->tpl->parse('song_reply_list_button_logged_block', 'song_reply_list_button_logged', TRUE); 
                                    }
                                }
                            }
                            $this->tpl->parse('song_reply_list_block', 'song_reply_list', TRUE);
                        }
                    }
                }  
                $this->tpl->parse('song_comment_list_block', 'song_comment_list', TRUE);
                $this->tpl->parse('song_reply_list_block', '');
            }
        }     
    }
}
