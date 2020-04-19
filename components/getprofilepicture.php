<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        session_start();
        $_SESSION['codeAnmelden'] = "<div id='error'>Melde dich bitte erstmal an!</div>";
        header('location: ../index.php');
        exit();
    }
    else {
        header('Content-Type: application/json');

        $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
        $upload_folder = '../profilepictures/';
        $filename = $_GET["profile"];
        foreach ($allowed_extensions as &$al_extension) {
            $file = $upload_folder . $filename . "." . $al_extension;
            if (file_exists($file)) {
                header('location: '.$file);
                die();
            }
        }
        header("location: ../ressources/logo.png");
        die();
    }
?>