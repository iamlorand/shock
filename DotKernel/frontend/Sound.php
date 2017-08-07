<?php

class Sound extends Dot_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getMusicList($page=1) {
	    $select=$this->db->select()
	                     ->from('sound');
	    $dotPaginator=new Dot_Paginator($select, $page, $this->settings->resultsPerPage);
    
        $result=$dotPaginator->getData();
        return $result;
    }
}