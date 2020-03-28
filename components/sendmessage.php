<?php
    session_start();
    if(!isset($_SESSION['username']) && isset($_POST["send"])) {
        session_start();
        $_SESSION['codeAnmelden'] = "<div id='error'>Melde dich bitte erstmal an!</div>";
        header('location: ../index.php');
        exit();
    }
    else {
        $message = filter_input(INPUT_POST, 'message',FILTER_SANITIZE_STRING); 

        if (empty($message))
        {
            header('location: ../chat/chat.php');
            exit();
        }

        $username = $_SESSION['username'];
        $u_id = $_SESSION['u_id'];
        
        $ini = parse_ini_file('../ressources/credentials.ini');
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

        $message = strval($message);

        # Holt die Daten aus der Datenbank
        $sql = "INSERT INTO Chat (U_ID, Nachricht) VALUES ('$u_id', $message)";
        if (!$conn->query($sql) === TRUE) {
            echo "Nachricht konnte nicht gesendet werden!";
        }
        $conn->close();
        header('location: ../chat/chat.php');
        exit();
    }
?>