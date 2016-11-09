<?php
session_start();
require("Model/Model.php");
require("Model/FilmManager.php");
require("Model/ConnexionManager.php");
require("Model/CommentManager.php");

$fm   = new FilmManager;
$cm   = new ConnexionManager;
$cmtM = new CommentManager;

/**********************/

if (isset($_GET['movieid'])) {
    $p_movieid = $_GET['movieid'];
    if ((int) $p_movieid < 0 or !(ctype_digit($p_movieid))) {
        require("Views/error.php?n=1");
    } else {
        $p_movieid         = (int) $p_movieid;
        $data_info_movie   = $fm->getFilmDetails($p_movieid);
        $data_info_casting = $fm->getCasting($p_movieid);
        if (isset($_SESSION['login'])) {
            $resultVote = $fm->checkVote($p_movieid, $_SESSION['UserID']);
            $checkVote  = count($resultVote);
            if ($checkVote > 1) {
                $voted = True;
            } else {
                $voted = false;
            }
        }
        if (isset($_POST['voteButton'])) {
            $fm->updateVote($p_movieid, $_SESSION['UserID']);
            header("Location: index.php?movieid=" . $p_movieid);
        }
        //************commentaires*************
        //enregistremant des commentaires
        if (isset($_SESSION['login'])) {
            if (isset($_POST['message'])) {
                //$lastID = $cmtM->maxCommentID($p_movieid);
                $cmtM->commentRegister($p_movieid, $_SESSION['login'], $_POST['message']);
            }
        }
        //récupération des commentaires
        $commentAside = $cmtM->getComments($p_movieid);

        require("Views/detailsFilm.php");
    }
} else if (isset($_GET['action']) && ($_GET['action'] == 'connexion')) {
    require("Views/connexion.php");
} else if (isset($_GET['action']) && ($_GET['action'] == 'connexion_sent')) {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        if (!preg_match('/[^A-Za-z0-9]/', $_POST['login'])) {
            $resultLogin = $cm->checkLogin($_POST['login']);
            $checkLogin  = count($resultLogin);
            if ($checkLogin > 0) {
                $resultConnexion = $cm->checkConnexion($_POST['login'], $_POST['password']);
                $checkConnexion  = count($resultConnexion);
                $login           = $_POST['login'];
                if ($checkConnexion > 0) {
                    $_SESSION['login']    = $login;
                    $_SESSION['password'] = $_POST['password'];
                    $password             = $_POST['password'];
                    $resultUser           = $cm->getUserid($login, $password);
                    $_SESSION['UserID']   = $resultUser[0];
                    header("Location: index.php");
                } else {
                    $messageErreur = 2;
                }
            } else {
                $messageErreur = 1;
            }
        } else {
            $messageErreur = 1;
        }
    } else {
        $messageErreur = 0;
    }
    require("Views/connexion.php");
} else if (isset($_GET['action']) && ($_GET['action'] == 'inscription')) {
    require("Views/inscription.php");
} else if (isset($_GET['action']) && ($_GET['action'] == 'inscription_sent')) {
    // Champs requis
    $requiredFields = array(
        'nom',
        'login',
        'password',
        'password2',
        'mail'
    );

    // On vérifie qu'aucun champ n'est vide
    $errorFields = false;
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errorFields = true;
        }
    }

    if ($errorFields == false) {
        if (!preg_match('/[^A-Za-z0-9]/', $_POST['nom']) && !preg_match('/[^A-Za-z0-9]/', $_POST['login'])) {
            if (!preg_match('/[^A-Za-z0-9]/', $_POST['password'])) {
                if ($_POST['password'] == $_POST['password2']) {
                    $resultLogin = $cm->checkLogin($_POST['login']);
                    $checkLogin  = count($resultLogin);
                    if ($checkLogin <= 0) {
                        /*logo*/
                        if (isset($_FILES['profilpic']) and $_FILES['profilpic']['size'] != 0) {
                            $inscription = $cm->inscription($_POST['login'], $_POST['password'], $_POST['nom'], $_POST['mail'], 1);
                            move_uploaded_file($_FILES['profilpic']['tmp_name'], "Web/images/" . $_POST['login']);
                        } else {
                            $inscription = $cm->inscription($_POST['login'], $_POST['password'], $_POST['nom'], $_POST['mail'], 0);
                        }
                        header("Location: index.php?action=connexion");
                    } else {
                        $messageErreur = 4;
                    }
                } else {
                    $messageErreur = 3;
                }
            } else {
                $messageErreur = 2;
            }
        } else {
            $messageErreur = 1;
        }
    } else {
        $messageErreur = 0;
    }
    require("Views/inscription.php");
} else if (isset($_GET['action']) && ($_GET['action'] == 'deconnexion')) {
    session_destroy();
    header("Location: index.php");
} else {
    $results = $fm->getFilms();
    $count   = count($results);
    require("Views/films.php");
}
?>
