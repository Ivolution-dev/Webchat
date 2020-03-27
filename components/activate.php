<?php
    $code = $_GET["confirm"];
        
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

    $sql = "UPDATE Nutzer SET Active = '1' WHERE Active = '$code'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_row($result);
    $conn->close();

    session_start();
    $_SESSION['codeAnmelden'] = "<div id='success'>Dein Account wurde aktiviert! Du kannst dich jetzt anmelden!</div>";
    header('location: ../index.php');
    exit();
?>