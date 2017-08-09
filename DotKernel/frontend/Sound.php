<?php

class Sound extends Dot_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getMusicList($page=1)
    {
	    $select=$this->db->select()
	                     ->from('sound');
	    $dotPaginator=new Dot_Paginator($select, $page, $this->settings->resultsPerPage);
    
        $result=$dotPaginator->getData();
        return $result;
    }
    #inserts a new upload into table sound
    public function insertUpload($valueArray)
    {
        $insert = $this->db->insert('sound', $valueArray);
    }
    public function getMusicById($id)
    { 
       $select=$this->db->select()
                ->from('sound')
                ->where('id =?',$id);
        $result=$this->db->fetchRow($select);
    
    return $result;
    }
}