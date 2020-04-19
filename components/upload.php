<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        session_start();
        $_SESSION['codeAnmelden'] = "<div id='error'>Melde dich bitte erstmal an!</div>";
        header('location: ../index.php');
        exit();
    } else {


        $upload_folder = '../profilepictures/'; //Das Upload-Verzeichnis
        $filename = $_SESSION['u_id'];
        $extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));

        //Überprüfung der Dateiendung
        $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
        if (!in_array($extension, $allowed_extensions)) {
            die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
        }

        foreach ($allowed_extensions as $al_extensions) {
            $file = $upload_folder.$filename.$al_extension;
            echo $file;
            if (file_exists($file)) {
                echo "yes";
                unlink($file);
                break;
            }
        }

        //Überprüfung der Dateigröße
        $max_size = 1000 * 1024; //1000 KB
        if ($_FILES['datei']['size'] > $max_size) {
            die("Bitte keine Dateien größer 1mb hochladen");
        }

        //Überprüfung dass das Bild keine Fehler enthält
        if (function_exists('exif_imagetype')) { //Die exif_imagetype-Funktion erfordert die exif-Erweiterung auf dem Server
            $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
            $detected_type = exif_imagetype($_FILES['datei']['tmp_name']);
            if (!in_array($detected_type, $allowed_types)) {
                die("Nur der Upload von Bilddateien ist gestattet");
            }
        }

        //Pfad zum Upload
        $new_path = $upload_folder . $filename . '.' . $extension;

        //Alles okay, verschiebe Datei an neuen Pfad
        move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
        echo 'Bild erfolgreich hochgeladen: <a href="' . $new_path . '">' . $new_path . '</a>';
    }
?>