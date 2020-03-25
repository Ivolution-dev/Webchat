<?php
    if(isset($_POST["register"])){
        $nutzer = filter_input(INPUT_POST, 'nutzer', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $passwort = filter_input(INPUT_POST, 'passwort', FILTER_SANITIZE_STRING);
        $passwortwh = filter_input(INPUT_POST, 'passwortwh', FILTER_SANITIZE_STRING);
        $hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        if (empty($nutzer) || empty($email) || empty($passwort)|| empty($passwortwh) || !ctype_alnum($nutzer)) {
            session_start();
            $_SESSION['codeRegister'] = "<div id='error'>Ungültige Daten! Du darfst nur Zeichen von a-z und 0-9 verwenden!</div>";
            header('location: ../index.php');
            exit();
        } else if ($passwort != $passwortwh) {
            session_start();
            $_SESSION['codeRegister'] = "<div id='error'>Die Passwörter stimmen nicht überein!</div>";
            header('location: ../index.php');
            exit();
        } else if (strlen($nutzer) > 8) {
            session_start();
            $_SESSION['codeRegister'] = "<div id='error'>Der Benutzername ist zu lang! <br>Der Name darf nicht länger als 8 Zeichen sein!</div>";
            header('location: ../index.php');
            exit();
        } else {
            $ini = parse_ini_file('../credentials.ini');
            $servername = $ini['db_ip'];
            $username = $ini['db_user'];
            $password = $ini['db_password'];
            $dbname = $ini['db_database'];

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: ".$conn->connect_error);
            }

            $sql1 = "SELECT * FROM Nutzer WHERE Nutzername LIKE '$nutzer' OR Email LIKE '$email'";
            $result1 = $conn->query($sql1);
            $rowcount = mysqli_num_rows($result1);
            if (intval($rowcount) > 0) {
                session_start();
                $_SESSION['codeRegister'] = "<div id='error'>Der Benutzer existiert bereits oder diese Email wurde bereits verwendet!</div>";
                header('location: ../index.php');
                exit();
            }
            
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = substr(str_shuffle($permitted_chars), 0, 20);

            # Holt die Daten aus der Datenbank
            $sql2 = "INSERT INTO Nutzer (Nutzername, Email, Passwort, Active) VALUES ('$nutzer', '$email', '$hash', '$code')";
            $result2 = $conn->query($sql2);
            $row2 = mysqli_fetch_row($result2);
            $conn->close();

            session_start();
            $_SESSION['empfaenger'] = $email;
            $_SESSION['betreff'] = 'Account Bestätigung';
            $_SESSION['mail'] = "Herzlich Willkommen bei Webchat $nutzer, \r\n\r\nUm deinen Account zu bestätigen, klicke bitte auf den Link: \r\n\r\nhttp://gamer-server.eu/Webchat/account.php?confirm=$code \r\nWenn du den Account nicht erstellt hast, kannst du diese Mail einfach ignorieren!";
            $_SESSION['codeRegister'] = "<div id='success'>Du hast dich erfolgreich Registriert! <br>Du musst erst noch deine Email Bestätigen!</div>";
            $_SESSION['backTo'] = "../index.php";

            header('location: ../components/sendmail.php');
            exit();
        }
    }
?>
