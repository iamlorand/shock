<?php

class Sound_View extends View
{
    public function __construct($tpl)
    {
        $this->tpl = $tpl;
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
}