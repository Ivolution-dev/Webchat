<?php
    if (isset($_POST["newpwbtn"])) {
        $nutzer = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

        $ini = parse_ini_file('../credentials.ini');
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

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $newpasswd = substr(str_shuffle($permitted_chars), 0, 5);
        $hash = password_hash($newpasswd, PASSWORD_DEFAULT);


        # Holt die Daten aus der Datenbank
        $sql = "SELECT Nutzername, Email FROM Nutzer where Nutzername = '$nutzer' OR Email = '$nutzer' SET Passwort = '$hash'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_row($result);
        $conn->close();

        session_start();
        $_SESSION['empfaenger'] = $row[1];
        $_SESSION['betreff'] = 'Account Bestätigung';
        $_SESSION['mail'] = "Dein Benutzername: $row[0]\r\nDein Neues Passwort: $newpasswd \r\nDu kannst dein Passwort jederzeit unter http://gamer-server.eu/Webchat/account/changepassword.php ändern";
        $_SESSION['codePassrs'] = "<div id='success'>Wenn deine Daten stimmen hast du jetzt eine Email bekommen!</div>";
        $_SESSION['backTo'] = "../account/forgetpassword.php";

        header('location: sendmail.php');
        exit();
    }
?>
