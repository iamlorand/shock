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
                            ->where('parentId=?', 0)
                            ->joinLeft('user', 'comment.userId = user.id', ['username' => 'username']);
        $result = $this->db->fetchAll($select);
        return $result;
    }
    #gets all replys by id from table comment
    public function getReplyById($id)
    {
        $select = $this->db->select()
                            ->from('comment')
                            ->where('parentId=?', $id)
                            ->joinLeft('user', 'comment.userId = user.id', ['username' => 'username']);
        $result = $this->db->fetchAll($select);
        return $result;
    }
    #gets all replys by id from table comment
    public function getReplysAndCommentsById($id)
    {
        $comepletedData = [];
        $parentsComments= $this->getCommentById($id);
        foreach ($parentsComments as $key => $value) {
            $replies = $this->getReplyById($value['id']);
            $comepletedData[$value['id']]['message'] = $value['message'];
            $comepletedData[$value['id']]['userId'] = $value['userId'];
            $comepletedData[$value['id']]['username'] = $value['username'];
            $comepletedData[$value['id']]['date'] = $value['date'];
            $comepletedData[$value['id']]['parentId'] = $value['parentId'];
            $comepletedData[$value['id']]['id'] = $value['id'];
            if(isset($replies) && !empty($replies))
            {
                $comepletedData[$value['id']]['replies'] = $replies;
            }
        }
        return $comepletedData;
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
        $deleteComment = $this->db->delete('comment', 'id = ' . $id);
        $deleteReply = $this->db->delete('comment', 'parentId = ' . $id);
    }
}