<?php

$soundView = new Sound_View($tpl);
$soundModel = new Sound();

$pageTitle = $option->pageTitle->action->{$registry->requestAction};
$session = Zend_Registry::get('session');

switch ($registry->requestAction)
{
    default:
    case 'upload':
        $upload = $soundView->upload('upload');
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $music_dir = "uploads/music/";
            $thumbnail_dir = "uploads/thumbnails/";
            $music_file = $music_dir . basename($_FILES["fileToUpload"]["name"]);
            $thumbnail_file = $thumbnail_dir . basename($_FILES["thumbnail"]["name"]);

            $insertArray = [];
            $insertArray['filename'] = $music_file;
            $insertArray['userId'] = $session->user->id;
            $insertArray['thumbnail'] = $thumbnail_file;
            $insertArray = array_merge($insertArray, $_POST);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $music_file);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $thumbnail_file);
            $soundModel->insertUpload($insertArray);
        }
        break;
     case 'list':
        $page=(isset($registry->request['page']) && $registry->request['page'] > 0 ) ? $registry->request['page'] : 1;
        $list=$soundModel->getMusicList($page);
        //var_dump($list);exit;
        $soundView->showMusic('show_list',$list,$page);
        
    break;
}
