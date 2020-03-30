<?php
    if (isset($_POST["resend"])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

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

        # Holt die Daten aus der Datenbank
        $sql = "SELECT Nutzername, Email, Active FROM Nutzer WHERE Email = '$email'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_row($result);
        $conn->close();

        $nutzer = $row[0];
        $email = $row[1];
        $code = $row[2];

        session_start();
        $_SESSION['empfaenger'] = $email;
        $_SESSION['betreff'] = 'Account Bestätigung';
        $_SESSION['mail'] = "Herzlich Willkommen bei Webchat $nutzer, \r\n\r\nUm deinen Account zu bestätigen, klicke bitte auf den Link: \r\n\r\nhttp://gamer-server.eu/Webchat/components/activate.php?confirm=$code \r\nWenn du den Account nicht erstellt hast, kannst du diese Mail einfach ignorieren!";
        $_SESSION['codeResend'] = "<div id='success'>Wenn deine Daten stimmen wird dir nun erneut eine Email gesendet!</div>";
        $_SESSION['backTo'] = "../account/resendmail.php";

        header('location: sendmail.php');
        exit();
    }
?>
