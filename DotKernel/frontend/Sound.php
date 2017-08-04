<?php

class Sound extends Dot_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    #inserts a new upload into table sound
    public function insertUpload($valueArray)
    {
        $insert = $this->db->insert('sound', $valueArray);
    }
}