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
    public function upload($template = '')
    {
        if (!empty($template))
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'sound/' . $this->template . '.tpl');
        }  
    }
    public function showMusic($template='', $list, $page = 1)
    {
        if ($template != '') $this->template=$template;
        $this->tpl->setFile('tpl_main','sound/'.$this->template.'.tpl');
        $this->tpl->setBlock('tpl_main','list_music','list_music_block');
        $this->tpl->paginator($list['pages']);
        $this->tpl->setVar('PAGE',$page);
        foreach ($list['data'] as $list => $music) {
            foreach ($music as $key => $value) {
                if ($key == 'thumbnail' && $value == '') {
                    $this->tpl->setVar(strtoupper($key), '{SITE_URL}images/frontend/vinyl_default.jpg');
                } else {
                    $this->tpl->setVar(strtoupper($key),$value); 
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
            foreach ($music as $musicContent) {
                foreach ($musicContent as $key => $value) {
                    $this->tpl->setVar('SONG_'.strtoupper($key), $value);
                }
            }
        }
    }

    #confirm deleting a record(song) by id
    public function showDeleteConfirmation($template = '', $music)
    {
        if (!empty($template))
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'sound/' . $this->template . '.tpl');
            foreach ($music as $musicContent) {
                foreach ($musicContent as $key => $value) {
                    $this->tpl->setVar('SONG_'.strtoupper($key), $value);
                }
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
            foreach ($music as $details) {
                foreach ($details as $key => $value) {
                    if ($key == 'thumbnail' && $value == '') {
                        $this->tpl->setVar('SONG_'.strtoupper($key), '{SITE_URL}images/frontend/vinyl_default.jpg');
                    } else {
                        $this->tpl->setVar('SONG_'.strtoupper($key),$value);
                    }
                 
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