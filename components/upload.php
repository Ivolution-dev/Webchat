<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        session_start();
        $_SESSION['codeAnmelden'] = "<div id='error'>Melde dich bitte erstmal an!</div>";
        header('location: ../index.php');
        exit();
    } else {
        $upload_folder = '../profilepictures/'; 
        $filename = $_SESSION['username'];
        $extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));

        $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
        if (!in_array($extension, $allowed_extensions)) {
            $_SESSION['codeUpload'] = "<div id='error'>Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt</div>";
            header('location: ../account/profile.php');
            exit();
        }

        $max_size = 1000 * 1024; //1000 KB
        if ($_FILES['datei']['size'] > $max_size) {
            $_SESSION['codeUpload'] = "<div id='error'>Bitte keine Dateien größer 1mb hochladen</div>";
            header('location: ../account/profile.php');
            exit();
        }

        if (function_exists('exif_imagetype')) { //Die exif_imagetype-Funktion erfordert die exif-Erweiterung auf dem Server
            $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
            $detected_type = exif_imagetype($_FILES['datei']['tmp_name']);
            if (!in_array($detected_type, $allowed_types)) {
                $_SESSION['codeUpload'] = "<div id='error'>Nur der Upload von Bilddateien ist gestattet</div>";
                header('location: ../account/profile.php');
                exit();
            }
        }

        foreach ($allowed_extensions as &$al_extension) {
            $file = $upload_folder.$filename.".".$al_extension;
            if (file_exists($file)) {
                unlink($file);
                break;
            }
        }

        $new_path = $upload_folder . $filename . '.' . $extension;

        move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
        $_SESSION['codeUpload'] = "<div id='success'>Dein Profilbild wurde aktualisiert!</div>";
        header('location: ../account/profile.php');
        exit();
    }
?>