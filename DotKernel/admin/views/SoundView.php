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
             $this->tpl->setVar(strtoupper($key),$value); 
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
}