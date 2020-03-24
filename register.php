<?php
    if(isset($_POST["register"])){
        $nutzer = filter_input(INPUT_POST, 'nutzer', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $passwort = filter_input(INPUT_POST, 'passwort', FILTER_SANITIZE_STRING);
        $hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        if (empty($nutzer) || empty($email) || empty($passwort)) {
            header('location: index.php?code=6');
            exit();
        } else if (strlen($nutzer) > 8) {
            header('location: index.php?code=7');
            exit();
        } else {
            $ini = parse_ini_file('credentials.ini');
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
                header('location: index.php?code=8');
                exit();
            }
            
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = substr(str_shuffle($permitted_chars), 0, 20);

            # Holt die Daten aus der Datenbank
            $sql2 = "INSERT INTO Nutzer (Nutzername, Email, Passwort, Active) VALUES ('$nutzer', '$email', '$hash', '$code')";
            $result2 = $conn->query($sql2);
            $row2 = mysqli_fetch_row($result2);
            $conn->close();


            $nachricht = "Herzlich Willkommen bei Webchat $nutzer, \r\n\r\nUm deinen Account zu bestätigen, klicke bitte auf den Link: \r\n\r\nhttp://gamer-server.eu/Webchat/account.php?confirm=$code \r\nWenn du den Account nicht erstellt hast, kannst du diese Mail einfach ignorieren!";
            $nachricht = wordwrap($nachricht, 70, "\r\n");
            mail($email, 'Account Bestätigung', $nachricht);

            header('location: index.php?code=3');
            exit();
        }
    }
?>
