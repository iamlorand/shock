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
    #gets all comments by id from table comment
    public function getCommentById($id)
    {
        $select = $this->db->select()
                            ->from('comment')
                            ->where('soundId=?', $id)
                            ->joinLeft('user', 'comment.userId = user.id', ['username' => 'username']);
        $result = $this->db->fetchAll($select);
        return $result;
    }
    #adds a single comment into the table comment
    public function addCommentById($a)
    {
        $insert = $this->db->insert('comment', $a);
    }
    #updates a comment into the table comment
    public function editCommentById($a, $commentId)
    {
        $update = $this->db->update('comment', $a, 'id = ' . $commentId);
    }
    #deletes comment by id
    public function deleteCommentById($id)
    {
        $delete = $this->db->delete('comment', 'id = ' . $id);
    }
}