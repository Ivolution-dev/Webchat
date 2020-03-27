<!DOCTYPE html>
<html lang="de">

<head>
    <title>Webchat</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style.css?v=1">
    <link rel="icon" type="image/png" href="../logo.png">
</head>

<body>
    <?php
    if (isset($_POST["login"])) {
        $nutzer = filter_input(INPUT_POST, 'nutzer', FILTER_SANITIZE_STRING);
        $passwort = filter_input(INPUT_POST, 'passwort', FILTER_SANITIZE_STRING);

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

        # Holt die Daten aus der Datenbank
        $sql = "SELECT U_ID, Nutzername, Passwort, Active FROM Nutzer where Nutzername = '$nutzer' OR Email = '$nutzer'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_row($result);
        $conn->close();
        if (password_verify($passwort, $row[2]) && !(empty($_POST["nutzer"]) || empty($_POST["passwort"]) || $row[0] == "")) {
            if ($row[3] == "1") {
                session_start();
                $_SESSION['username'] = $row[1];
                $_SESSION['u_id'] = $row[0];
                header('location: ../chat/chat.php');
                exit();
            } else {
                session_start();
                $_SESSION['codeAnmelden'] = "<div id='error'>Du musst erst deine Email bestätigen!</div>";
                header('location: ../index.php');
                exit();
            }
        } else {
            session_start();
            $_SESSION['codeAnmelden'] = "<div id='error'>Falscher Benutzername oder Passwort</div>";
            header('location: ../index.php');
            exit();
        }
    } else if (!isset($_SESSION['username'])) {
        header('location: ../chat/chat.php');
        exit();
    } else {
        session_start();
        $_SESSION['codeAnmelden'] = "<div id='error'>Melde dich bitte erstmal an!</div>";
        header('location: ../index.php');
        exit();
    }
    ?>
</body>

</html>