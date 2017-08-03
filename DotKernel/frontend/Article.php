<?php

class Article extends Dot_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    #get all articles from table article
    public function getArticleList()
    {
        $select = $this->db->select()
                ->from('article');
        $result = $this->db->fetchAll($select);
        return $result;
    }
    #get article by id from table article
    public function getArticleById($id)
    {
        $select = $this->db->select()
                ->from('article')
                ->where('id=?', $id);
        $result = $this->db->fetchAll($select);
        return $result;
    }
}