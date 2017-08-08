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
            $insertArray['userId'] = $session->admin->id;
            $insertArray['thumbnail'] = $thumbnail_file;
            $insertArray = array_merge($insertArray, $_POST);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $music_file);
            move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $thumbnail_file);
            $soundModel->insertUpload($insertArray);
            $registry->session->message['txt'] = $option->infoMessage->songAdd;
            $registry->session->message['type'] = 'info';
            header('Location:'.$registry->configuration->website->params->url .'/admin/' . $registry->requestController .'/list/');
            exit;
        }
        break;

    case 'list':
        $page=(isset($registry->request['page']) && $registry->request['page'] > 0 ) ? $registry->request['page'] : 1;
        $list=$soundModel->getMusicList($page);
        $soundView->showMusic('show_list',$list,$page);
        break;

    case 'delete':
        if ((isset($registry->request['id'])) && (($registry->request['id']) > 0)) {
            $id = $registry->request['id'];
            $song = $soundModel->getSongById($id);
            $soundView->showDeleteConfirmation('delete_song', $song);
            if($_SERVER['REQUEST_METHOD'] === "POST")
            {
                if ('on' == $_POST['confirm'])
                {
                    $soundModel->deleteSong($id);
                    $registry->session->message['txt'] = $option->infoMessage->songDelete;
                    $registry->session->message['type'] = 'info';
                }
                else
                {
                    $registry->session->message['txt'] = $option->infoMessage->noSongDelete;
                    $registry->session->message['type'] = 'info';
                }
                header('Location:'.$registry->configuration->website->params->url .'/admin/' . $registry->requestController .'/list/');
                exit;
            }
        }
        break;

    case 'update':
        $id = $registry->request['id'];
        $song = $soundModel->getSongById($id);
        $soundView->showSongEdit('edit_song', $song);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $soundModel->updateSong($_POST, $id);
            $registry->session->message['txt'] = $option->infoMessage->songUpdate;
            $registry->session->message['type'] = 'info';
            header('Location:' . $registry->configuration->website->params->url . '/admin/'. $registry->requestController . '/list/');
            exit;
        }
        break;

    case 'show':
        $id = $registry->request['id'];
        $song = $soundModel->getSongById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (array_key_exists('id', $_POST)) {
                $comment = [
                        'message' => strip_tags($_POST['text']),
                        'id' => $_POST['id']
                        ];
                $soundModel->editCommentById($comment, $_POST['id']);
            } elseif (array_key_exists('delete', $_POST)) {
                $soundModel->deleteCommentById($_POST['delete']);
            }
        }
        $comments = $soundModel->getCommentById($id);
        $soundView->showSong('show_song', $song, $comments);
        break;
}
