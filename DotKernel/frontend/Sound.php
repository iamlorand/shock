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
                            ->where('sound.id=?', $id)
                            ->join('user','user.id=sound.userId', ['username' => 'username']);
        $result = $this->db->fetchRow($select);
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

    public function getMusicListBySearchWord($searchWord, $page = 1) 
    { 
        $select = $this->db->select()
                            ->from('sound')
                            ->where("title LIKE ?" ,'%'.$searchWord.'%');
                      
        $dotPaginator=new Dot_Paginator($select, $page, $this->settings->resultsPerPage);
    
        $result=$dotPaginator->getData();
        return $result;
      

    }
    #returns search results filtered by a tag
    public function getMusicListByTag($tag, $page = 1) 
    { 
        $select = $this->db->select()
                            ->from('sound')
                            ->where("tags LIKE ?" , $tag);
                      
        $dotPaginator=new Dot_Paginator($select, $page, $this->settings->resultsPerPage);
    
        $result=$dotPaginator->getData();
        return $result;
    }
    //top 50 order by viewCount
    public function top50(){
        $select = $this->db->select()
                            ->from('sound')
                            ->order('viewCount DESC')
                            ->limit(50);
                      
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
    #inserts a rating into the table rating
    public function insertRating($data)
    {
        $update = $this->db->insert('rating', $data);
    }
    #updates a rating into the table rating
    public function updateRating($data, $id)
    {
        $update = $this->db->update('rating', $data, 'id = ' . $id);
    }
    #check a rating into the table rating
    public function checkRating($soundId, $userId)
    {
        $select = $this->db->select()
                            ->from('rating')
                            ->where('soundId=?', $soundId)
                            ->where('userId=?', $userId);
        $result = $this->db->fetchRow($select);
        return $result;
    }
    #check a ratingCount in the table rating
    public function checkRatingCount($soundId)
    {
        $select = $this->db->select()
                            ->from('rating')
                            ->where('soundId=?', $soundId)
                            ->where('rating=?', 1);
        $result = count($this->db->fetchAll($select));
        return $result;
    }
    #updates a viewCount into the table sound
    public function updateViewCount($data, $id)
    {
        $update = $this->db->update('sound', $data, 'id = ' . $id);
    }
    #returns a playlist from table playlist by playlist(id)
    public function getPlaylistById($id)
    {
        $select = $this->db->select()
                            ->from('playlistSong')
                            ->where('playlist=?', $id)
                            ->joinLeft('sound', 'playlistSong.soundId = sound.id', ['filename' => 'filename',
                                                                                    'title' => 'title',
                                                                                    'description' => 'description']);
        $result = $this->db->fetchAll($select);
        return $result;
    }
    #creates a new playlist
    public function createPlaylist($data)
    {
        $insert = $this->db->insert('playlist', $data);
    }
    #returns all the playlists of the logged user
    public function playlistlist($userid)
    {
        $select = $this->db->select()
                            ->from('playlist')
                            ->where('userId=?', $userid);
        $result = $this->db->fetchAll($select);
        return $result;
    }
    #deletes playlist by id
    public function deletePlaylist($id)
    {
        $deletePlaylist = $this->db->delete('playlist', 'id = ' . $id);
        $deletePlaylistSong = $this->db->delete('playlistSong', 'playlist = ' . $id);
    }
    #adds a song into the table playlistSong
    public function addSongToPlaylistById($data)
    {
        $insert = $this->db->insert('playlistSong', $data);
    }
    #deletes playlist by id
    public function deleteFromPlaylist($songId, $playlistId)
    {
        $deletePlaylist = $this->db->delete('playlistSong', ['id = ' . $songId,
                                                            'playlist = ' . $playlistId
                                                            ]);
    }
    #returns all genre from table genre
    public function getGenreList()
    {
        $select = $this->db->select()
                            ->from('genre');
        $result = $this->db->fetchAll($select);
        return $result;
    }
}
