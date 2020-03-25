<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header('location: index.php?code=1');
        exit();
    }
    else {
        header('Content-Type: application/json');

        $aResult = array();
        $aResult2 = array();

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
        $sql1 = "Select U_ID, Nachricht from Chat";

        $tempArray = array();

        foreach ($conn->query($sql1) as $row) {
            $senderUID = $row['U_ID'];
            $result2 = $conn->query("Select Nutzername from Nutzer where U_ID = $senderUID");
            $row2 = mysqli_fetch_row($result2);
            array_push($tempArray, [$row2[0], $row['Nachricht']]);
        }
        $conn->close();

        $jsonData = json_encode($tempArray);
        echo $jsonData;
    }
?>