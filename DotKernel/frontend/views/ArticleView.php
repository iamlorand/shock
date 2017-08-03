<?php

class Article_View extends View
{
    public function __construct($tpl)
    {
        $this->tpl = $tpl;
        $this->settings = Zend_Registry::get('settings');
        $this->session = Zend_Registry::get('session');
    }

    public function showArticleList($template = '', $articleList)
    {
        if (!empty($template))
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'article/' . $this->template . '.tpl');
            $this->tpl->setBlock('tpl_main', 'article_list', 'article_list_block');
            foreach ($articleList as $article) {
                foreach ($article as $key => $value) {
                    $this->tpl->setVar('ARTICLE_'.strtoupper($key), $value);
                }
                $this->tpl->parse('article_list_block', 'article_list', TRUE);
            }
        }
    }

    public function showArticleContent($template = '', $articleList)
    {
        if (!empty($template))
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'article/' . $this->template . '.tpl');
            foreach ($articleList as $article) {
                foreach ($article as $key => $value) {
                    $this->tpl->setVar('ARTICLE_'.strtoupper($key), $value);
                }
            }
            $this->tpl->setBlock('tpl_main', 'comment', 'comment_block');
            if (isset($this->session->user))
            {

                $this->tpl->parse('comment_block', 'comment', TRUE);
            }
            else
            {
                $this->tpl->parse('comment_block', '');
            }
        }
    }
}