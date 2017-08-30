<?php

$session = Zend_Registry::get('session');
$settings = Zend_Registry::get('settings');

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

            if (file_exists($_FILES['thumbnail']['tmp_name']))
            {

                $a="./images/".$file_name;
                list($width, $height) = getimagesize($a);
                $newwidth = "300"; 
                $newheight = "200";
                $thumb = imagecreatetruecolor($newwidth, $newheight);
                $source = imagecreatefromjpeg($a);
                imagecopyresized($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagejpeg($dest, $a, 100);


                foreach ($_FILES['thumbnail'] as $type => $dataValue) {

                    $validatedFile = validateImg($type, $dataValue);
                    if($validatedFile !== true)
                    {
                        $countError[$type] = $validatedFile;
                    }
                }
            }if (file_exists($_FILES['fileToUpload']['tmp_name']))
            {
                foreach ($_FILES['fileToUpload'] as $type => $dataValue) {
                    $validatedFile = validateSong($type, $dataValue);
                    if($validatedFile !== true)
                    {
                        $countError1[$type] = $validatedFile;
                    }
                }
            }

            //POST values that will be validated
            $values = [
                'title'=> [
                    'title' => str_replace(" ", "", strip_tags($_POST['title'])) ?? '',
                ],
                'description'=> [
                    'description'=> str_replace(" ", "", strip_tags($_POST['description'])) ?? '',
                ],
                'tags'=> [
                    'tags'=> str_replace(" ", "", strip_tags($_POST['tags'])) ?? ''
                ]
            ];


            $dotValidateSong = new Dot_Validate_Sound(array('who' => 'user', 'action' => 'add', 'values' => $values));

            if($dotValidateSong->isValid() && empty($countError)  && empty($countError1))
            {
                $data =  $dotValidateSong->getData();
                $data = $_POST;
                
                $data['userId'] = $registry->session->user->id;
                //$data['filename'] = $_FILES["fileToUpload"];
                
                
            $thumbnail_dir = "uploads/thumbnails/";
            $thumbnail_file = $thumbnail_dir . basename($_FILES["thumbnail"]["name"]);
            $music_dir = "uploads/music/";
            $music_file = $music_dir . basename($_FILES["fileToUpload"]["name"]);
            move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $thumbnail_file);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $music_file);
            $data['thumbnail'] = $thumbnail_file;
            $data['filename'] = $music_file;
            // echo "<pre>";
            // var_dump($data);exit;
            

            $soundModel->insertUpload($data);
            
            $session->message['txt'] = $option->infoMessage->update;
            $session->message['type'] = 'info';

                header('Location:'.$registry->configuration->website->params->url .'/' . $registry->requestController);
                exit;
            }
        }
        
        break;


     case 'list':
        $page=(isset($registry->request['page']) && $registry->request['page'] > 0 ) ? $registry->request['page'] : 1;
        $list = $soundModel->getMusicList($page);
        if($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $session->searchedFor = $_POST['search'];
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['genre'])) {
            $queryTag = strtolower(strip_tags($_GET['genre']));
            $musicListByTag = $soundModel->getMusicListByTag($queryTag);
            $soundView->showMusic('show_list', $musicListByTag, $page);
        } else {
            if(isset($session->searchedFor) && !empty($session->searchedFor))
            {
                $list=$soundModel->getMusicListBySearchWord($session->searchedFor, $page);
            }
            if(isset($session->user->id)) {
                $userId = $session->user->id;
                $playlistList = $soundModel->playlistlist($userId);
                $soundView->showMusic('show_list',$list,$page, $playlistList);
            } else {
                $soundView->showMusic('show_list',$list,$page);
            }
        }

        

        break;

    case 'show_song':
        $id = $registry->request['id'];
        $song = $soundModel->getSongById($id);
        $ratingCount = $soundModel->checkRatingCount($id);    

        if(!isset($session->user->id)) {
            $comments = $soundModel->getReplysAndCommentsById($id);
            $soundView->showSongById('show_songdescription',$song, $comments, '', $ratingCount);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_SESSION['message'] = $_POST['text'];
                $_SESSION['redirectURL'] = 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
                header('Location:' . $registry->configuration->website->params->url . '/user/login?returnurl=' . $_SESSION['redirectURL']);
                exit;
            }
        } else {
            $checkRating = $soundModel->checkRating($id, $session->user->id);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (array_key_exists('id', $_POST)) {

                    $comment = [
                            'message' => strip_tags($_POST['text']),
                            'id' => $_POST['id']
                            ];
                    $soundModel->editCommentById($comment, $_POST['id']);
                } elseif (array_key_exists('delete', $_POST)) {
                    $soundModel->deleteCommentById($_POST['delete']);
                } else {
                    if (array_key_exists('parentId', $_POST)) {
                        $comment = [
                                        'userId' => $session->user->id,
                                        'message' => strip_tags($_POST['text']),
                                        'soundId' => $id,
                                        'parentId' => $_POST['parentId']
                                    ];
                    } else {
                        $comment = [
                                        'userId' => $session->user->id,
                                        'message' => strip_tags($_POST['text']),
                                        'soundId' => $id
                                    ];
                    }
                    $soundModel->addCommentById($comment);
                } 
            }
            $comments = $soundModel->getReplysAndCommentsById($id);
            $soundView->showSongById('show_songdescription', $song, $comments, $checkRating, $ratingCount);
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
            header('Location:' . $registry->configuration->website->params->url . '/'. $registry->requestController . '/list/');
            exit;
        }
        break;

    case 'rating':
        if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['status']))) {                
            if (($_POST['status'] == 0) || ($_POST['status'] == 1)){
                
                $queryArray = [];
                $queryArray['soundId'] = $_POST['soundId'];
                $queryArray['userId'] = $session->user->id;
                $queryArray['rating'] = ($_POST['status'] == '0') ? 1 : 0;

                $checkRating = $soundModel->checkRating($_POST['soundId'], $session->user->id);
                if (empty($checkRating)) {
                    $soundModel->insertRating($queryArray);
                } else {
                    $soundModel->updateRating($queryArray, $checkRating['id']);
                }

                $result = [
                    "success" => "true",
                    "status" => -1 * $_POST['status'] + 1,
                    "count" => $soundModel->checkRatingCount($_POST['soundId'])
                    ];

                echo Zend_Json::encode($result);
                exit();
            }
        }
        break;

    case 'viewed':
        //updating viewCount
        $id = $_POST['soundId'];
        $song = $soundModel->getSongById($id);

        $response = [
                'success' => false,
                'message' => 'Invalid viewed parameter provided!',
                'data' => [
                            'viewed' => false
                        ]
            ];
        $viewed = $_POST['viewed'] ?? 'error';
        if ($viewed == true) {
            $viewIncrement = [];
            $viewIncrement['viewCount'] = ++$song['viewCount'];
            $soundModel->updateViewCount($viewIncrement, $id);
            $response['data']['viewed'] = true;
            $response['success'] = true;
            $response['message'] = 'viewed successfully';

            echo Zend_Json::encode($response);
            exit();
        }
        
        break;

    case 'top50':
        if (isset($session->user->id)) {
            $userId = $session->user->id;
            $playlistList = $soundModel->playlistlist($userId);
            $list= $soundModel->top50();
            $soundView->top50('top50', $list, $playlistList);
        } else {
            $list= $soundModel->top50();
            $soundView->top50('top50',$list);
        }

        break;
        case 'allplaylist':
        if (isset($session->user->id)) {
            $userId = $session->user->id;
            $playlistList = $soundModel->playlistlist($userId);
            $soundView->allMyPlaylists('allplaylist', $playlistList);
        } else {
            header('Location:' . $registry->configuration->website->params->url . '/user/login');
            exit;
        }
        break;

    case 'myplaylist':
        $id = $registry->request['id'];
        $requestedPlaylist = $soundModel->getPlaylistById($id);
        $soundView->myPlaylist('myplaylist', $requestedPlaylist);
        break;

    case 'createplaylist':
        $createPlaylist = $soundView->createPlaylist('createplaylist');
        if (isset($session->user->id)) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $insertArray = [];
                $insertArray['userId'] = $session->user->id;
                foreach ($_POST as $key => $value) {
                    $insertArray[$key] = strip_tags($value);
                }
                if ($soundModel->createPlaylist($insertArray)) {
                    header('Location:' . $registry->configuration->website->params->url . $registry->requestController . '/allplaylist');
                    exit;
                } else {
                    header('Location:'.$registry->configuration->website->params->url .'/' . $registry->requestController . '/allplaylist');
                    exit;
                }
            }
        } else {
            header('Location:' . $registry->configuration->website->params->url . '/user/login');
            exit;
        }
        break;

    case 'addtoplaylist':
        if (isset($session->user->id)) {
            $userId = $session->user->id;
            if ((isset($_POST['playlistId'])) && (($_POST['soundId']) > 0)
                && (isset($_POST['soundId'])) && (($_POST['playlistId']) > 0)) {

                $insertArray = [];
                if (is_numeric($_POST['soundId']) && is_numeric($_POST['playlistId'])) {
                    $insertArray['soundId'] = $_POST['soundId'];
                    $insertArray['playlist'] = $_POST['playlistId'];
                    $insertArray['userId'] = $userId;

                    $soundModel->addSongToPlaylistById($insertArray);
                    
                    $response = [
                            'success' => true,
                            'message' => 'Added successfully!'
                            ];
                } else {
                    $response = [
                            'success' => false,
                            'message' => 'Something went wrong successfully!'
                            ];
                }

                echo Zend_Json::encode($response);
                exit;
            }
        } else {
            header('Location:' . $registry->configuration->website->params->url . '/user/login');
            exit;
        }
        break;

    case 'deleteplaylist':
        if (isset($session->user->id)) {
            if ((isset($registry->request['id'])) && (($registry->request['id']) > 0)) {
                $id = $registry->request['id'];
                $userId = $session->user->id;

                if ($soundModel->deletePlaylist($id)) {
                    header('Location:' . $registry->configuration->website->params->url .'/' . $registry->requestController . '/allplaylist');
                    exit;  
                } else {
                    header('Location:' . $registry->configuration->website->params->url .'/' . $registry->requestController . '/allplaylist');
                    exit;
                }
            }
        } else {
            header('Location:' . $registry->configuration->website->params->url . '/user/login');
            exit;
        }
        break;

    case 'deletefromplaylist':
        if (isset($session->user->id)) {
            if ((isset($_POST['playlistId'])) && (($_POST['soundId']) > 0)
                && (isset($_POST['soundId'])) && (($_POST['playlistId']) > 0)) {

                $songId = $_POST['soundId'];
                $playlistId = $_POST['playlistId'];

                $response = [
                            'success' => true,
                            'message' => 'Deleted successfully!'
                            ];

                $soundModel->deleteFromPlaylist($songId, $playlistId);

                echo Zend_Json::encode($response);
                exit;
            } else {
                $response = [
                            'success' => false,
                            'message' => 'Invalid soundId or playlistId parameter!'
                            ];

                echo Zend_Json::encode($response);
                exit;
            }
        } else {
            header('Location:' . $registry->configuration->website->params->url . '/user/login');
            exit;
        }
        break;
}

function validateImg($type, $data)
{
    $errors = [];


    if($type == 'size')
    {
    $allowedSize = 2097152;
        if($data > $allowedSize)
        {
            $errors[] = "Your image size " . $data . " is too big!";
        }
    }
    if($type == 'type')
    {
        $allowedType = ["image/jpeg" => "image/jpeg","image/jpg" => "image/jpg"];
        if(!array_key_exists($data, $allowedType))
        {
            $errors[] = "Your image type " . $data . " is not allowed!";
        }
    }



    if(count($errors) === 0)
    {
        return true;
    }
    else
    {
        return $errors;
    }
}

function validateSong($type, $data)
{
    $errors = [];
    if($type == 'size')
    {  $mb=1048576;
        $allowedSize = 15*$mb;
        if($data > $allowedSize)
        {
            $errors[] = "Your file size " . $data . " is too big!";
        }
    }
    if($type == 'type')
    {
        $allowedType = ["audio/mp3" => "audio/mp3"];
        if(!array_key_exists($data, $allowedType))
        {
            $errors[] = "Your file  type " . $data . " is not allowed!";
        }
    }
    if(count($errors) === 0)
    {
        return true;
    }
    else
    {
        return $errors;
    }
}