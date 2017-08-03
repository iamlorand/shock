<?php

class Article extends Dot_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    #gets all articles from table article
    public function getArticleList($page = 1)
    {
        $select = $this->db->select()
                            ->from('article');
        $dotPaginator = new Dot_Paginator($select, $page, $this->settings->resultsPerPage);
        $result = $dotPaginator->getData();
        return $result;
    }
    #adds an articles into table article
    public function addArticle($a)
    {
        $insert = $this->db->insert('article', $a);
    }
    #gets an article from table articles by id
    public function getArticleById($id)
    {
        
        $select = $this->db->select()
                            ->from('article')
                            ->where('id=?', $id);
        $result = $this->db->fetchAll($select);
        return $result;
    }
    #deletes an article from table article by id
    public function deleteArticle($id)
    {
        $delete = $this->db->delete('article', 'id = ' . $id);
    }
    #updates an article in table article by id
    public function updateArticle($a, $id)
    {
        $update = $this->db->update('article', $a, 'id = ' . $id);
    }
}