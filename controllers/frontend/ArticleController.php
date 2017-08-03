<?php

$articleView = new Article_View($tpl);
$articleModel = new Article();
$session = Zend_Registry::get('session');

// all actions MUST set  the variable  $pageTitle
$pageTitle = $option->pageTitle->action->{$registry->requestAction};
switch ($registry->requestAction)
{
    default:
    case 'list':
        $articleList = $articleModel->getArticleList();
        $articleView->showArticleList('article_list', $articleList);
        break;
    case 'show_article':
        $articleList = $articleModel->getArticleList();
        $id = $registry->request['id'];
        $artData = $articleModel->getArticleById($id);
        $articleView->showArticleContent('article_content', $artData);
        break;
}