<?php

$articleView = new Article_View($tpl);
$articleModel = new Article();
$pageTitle = $option->pageTitle->action->{$registry->requestAction};

switch ($registry->requestAction) {
    default:
    case 'list':
        $page = (isset($registry->request['page']) && $registry->request['page'] > 0) ? $registry->request['page'] : 1;
        $list = $articleModel->getArticleList($page);
        $articleView->showArticleList('list_article', $list, $page);
        break;

    case 'edit':
        $id = $registry->request['id'];
        $article = $articleModel->getArticleById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $articleModel->updateArticle($_POST, $id);
            header('Location:' . $registry->configuration->website->params->url . '/admin/'. $registry->requestController . '/edit/id/' . $id);
        }
        $articleView->showArticleEdit('edit_article', $article);
        break;

    case 'add':
        $newArticle = $articleView->addNewArticle('article_add');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $articleModel->addArticle($_POST);
        }
        break;

    case 'delete':
        $page = (isset($registry->request['page']) && $registry->request['page'] > 0) ? $registry->request['page'] : 1;
        $list = $articleModel->getArticleList($page);
        $articleView->showArticleList('article_delete', $list, $page);
        if ((isset($registry->request['id'])) && (($registry->request['id']) > 0)) {
            $id = $registry->request['id'];
            $articleModel->deleteArticle($id);
            header('Location:' . $registry->requestAction .'/');
        }
        break;

    case 'show':
        $id = $registry->request['id'];
        $article = $articleModel->getArticleById($id);
        $articleView->showArticleContent('article_content', $article);
        break;
}