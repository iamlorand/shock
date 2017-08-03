<?php

class Article_View extends View
{
    public function __construct($tpl)
    {
        $this->tpl = $tpl;
        $this->settings = Zend_Registry::get('settings');
        $this->session = Zend_Registry::get('session');
    }
    #displays all articles from table article
    public function showArticleList($template = '', $articleList, $page)
    {
        if (!empty($template))
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'article/' . $this->template . '.tpl');
            $this->tpl->setBlock('tpl_main', 'article_list', 'article_list_block');
            $this->tpl->paginator($articleList['pages']);
            $this->tpl->setVar('PAGE', $page);
            foreach ($articleList['data'] as $k => $article) {
                foreach ($article as $key => $value) {
                    if ($key == 'content') {
                        $this->tpl->setVar('ARTICLE_'.strtoupper($key), substr($value, 0, 50));
                    } else {
                        $this->tpl->setVar('ARTICLE_'.strtoupper($key), $value);
                    }
                }
                $this->tpl->parse('article_list_block', 'article_list', TRUE);
            }
        }
    }
    #displays a single articles content from table article
    public function showArticleContent($template = '', $article)
    {
        if (!empty($template))
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'article/' . $this->template . '.tpl');
            foreach ($article as $articleContent) {
                foreach ($articleContent as $key => $value) {
                    $this->tpl->setVar('ARTICLE_'.strtoupper($key), $value);
                }
            }
        }
    }
    #adds a new article to the table article
    public function  addNewArticle($template = '')
    {
        $this->template = $template;
        $this->tpl->setFile('tpl_main', 'article/' . $this->template . '.tpl');
    }
    #with this function you can edit an article by id
    public function showArticleEdit($template = '', $article)
    {
        if (!empty($template))
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'article/' . $this->template . '.tpl');
            foreach ($article as $articleContent) {
                foreach ($articleContent as $key => $value) {
                    $this->tpl->setVar('ARTICLE_'.strtoupper($key), $value);
                }
            }
        }
    }
}