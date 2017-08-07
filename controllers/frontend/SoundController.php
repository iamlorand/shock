<?php

$soundView = new Sound_View($tpl);
$soundModel = new Sound();

$pageTitle = $option->pageTitle->action->{$registry->requestAction};



switch ($registry->requestAction)
{
    default:
    case 'upload':
        $upload = $soundView->upload('upload');
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $target_dir = "uploads/music/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }
        break;
     case 'list':
        $page=(isset($registry->request['page']) && $registry->request['page'] > 0 ) ? $registry->request['page'] : 1;
        $list=$soundModel->getMusicList($page);
        //var_dump($list);exit;
        $soundView->showMusic('show_list',$list,$page);
        
    break;
}



