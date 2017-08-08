<?php

class Sound extends Dot_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    #returns all records from table sound
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
    #deletes a record from table sound by id
    public function deleteSong($id)
    {
        $delete = $this->db->delete('sound', 'id = ' . $id);
    }
    #updates a record from table sound by id
    public function updateSong($a, $id)
    {
        $update = $this->db->update('sound', $a, 'id = ' . $id);
    }
    #returns a record from table sound by id
    public function getSongById($id)
    {
        $select = $this->db->select()
                            ->from('sound')
                            ->where('id=?', $id);
        $result = $this->db->fetchAll($select);
        return $result;
    }
}