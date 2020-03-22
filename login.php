<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Webchat</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            if(isset($_POST["login"])){
                $nutzer = filter_input(INPUT_POST, 'nutzer', FILTER_SANITIZE_STRING); 
                $passwort = filter_input(INPUT_POST, 'passwort', FILTER_SANITIZE_STRING);
                
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

                # Holt die Daten aus der Datenbank
                $sql = "SELECT U_ID, Nutzername, Passwort, Active FROM Nutzer where Nutzername = '$nutzer'";
                $result = $conn->query($sql);
                $row = mysqli_fetch_row($result);
                $conn->close();
                if (password_verify($passwort, $row[2]) && !(empty($_POST["nutzer"]) || empty($_POST["passwort"]) || $row[0] == "")) {
                    if ($row[3] == "1") {
                        session_start();
                        $_SESSION['username'] = $nutzer;
                        $_SESSION['u_id'] = $row[0];
                        header('location: chat.php');
                        exit();
                    } else {
                        header('location: index.php?code=4');
                        exit();
                    }
                } else {
                    header('location: index.php?code=0');
                    exit();
                }
            } else if (!isset($_SESSION['username'])) {
                header('location: chat.php');
                exit();
            } else {
                header('location: index.php?code=1');
                exit();
            }
        ?>
    </body>
</html>