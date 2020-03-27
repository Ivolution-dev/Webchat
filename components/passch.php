<?php
    if (isset($_POST["change"])) {
        $oldpw = filter_input(INPUT_POST, 'oldpw', FILTER_SANITIZE_STRING);
        $newpw = filter_input(INPUT_POST, 'newpw', FILTER_SANITIZE_STRING);
        $newpwcn = filter_input(INPUT_POST, 'newpwcn', FILTER_SANITIZE_STRING);
        $username = $_SESSION['username'];

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

        if ($newpw == $newpwcn) {
            $sql = "SELECT U_ID, Nutzername, Passwort FROM Nutzer where Nutzername = '$nutzer' OR Email = '$nutzer'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_row($result);
            if () {
            $hash = 

            # Holt die Daten aus der Datenbank
            $sql = "UPDATE Nutzer SET Passwort = '$hash' WHERE Nutzername = '$username'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_row($result);
            $conn->close();
            
            session_start();
            $_SESSION['codeChangePassword'] = "<div id='error'>Melde dich bitte erstmal an!</div>";
            header('location: ../account/changepassword.php');
            } else {
                session_start();
                $_SESSION['codeChangePassword'] = "<div id='error'>Dein alten Passwort stimmt nicht!</div>";
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
