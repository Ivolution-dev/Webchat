<?php
    if (isset($_POST["change"])) {
        $oldpw = filter_input(INPUT_POST, 'oldpw', FILTER_SANITIZE_STRING);
        $newpw = filter_input(INPUT_POST, 'newpw', FILTER_SANITIZE_STRING);
        $newpwcn = filter_input(INPUT_POST, 'newpwcn', FILTER_SANITIZE_STRING);
        $nutzer = $_SESSION['username'];

        $ini = parse_ini_file('../ressources/credentials.ini');
        $servername = $ini['db_ip'];
        $username = $ini['db_user'];
        $password = $ini['db_password'];
        $dbname = $ini['db_database'];

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($newpw == $newpwcn) {
            $sql = "SELECT U_ID, Nutzername, Passwort FROM Nutzer WHERE Nutzername = '$nutzer'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_row($result);
            if (password_verify($oldpw, $row[2])) {

                $hash = password_hash($newpwcn, PASSWORD_DEFAULT);

                # Holt die Daten aus der Datenbank
                $sql2 = "UPDATE Nutzer SET Passwort = '$hash' WHERE U_ID = '$row[0]'";
                $conn->query($sql2);
                $conn->close();
                
                session_start();
                $_SESSION['codeChangePassword'] = "<div id='success'>Dein Passwort wurde erfolgreich geändert!</div>";
                header('location: ../account/changepassword.php');
            } else {
                session_start();
                $_SESSION['codeChangePassword'] = "<div id='error'>Dein altes Passwort stimmt nicht!</div>";
                header('location: ../account/changepassword.php');
            }
        } else {
            session_start();
            $_SESSION['codeChangePassword'] = "<div id='error'>Deine daten stimmen nicht überein!</div>";
            header('location: ../account/changepassword.php');
        }
        header('location: sendmail.php');
        exit();
    } else {
        header('location: ../account/changepassword.php');
        exit();
    }
?>
