<!DOCTYPE html>
<html lang="de">

<head>
    <title>Webchat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ressources/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
    <link rel="icon" type="image/png" href="../ressources/logo.png">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['username'])) {
        header('location: ../chat/chat.php');
        exit();
    }
    ?>

    <h1 id="reghd"> Passwort zurücksetzen </h1>
    <div class="feld">
        <form action="../components/passrs.php" method="post">
            Email : <input type="text" name="email" autocomplete="off"><br><br>
            <input type="submit" value="Passwort zurücksetzen!" name="newpwbtn">
            <a class="link" href="../account/profile.php">Zurück zum Profil!</a>
        </form>
    </div>
    <?php
    if (isset($_SESSION['codePassrs']) && $_SESSION['codePassrs'] != "") {
        echo ($_SESSION['codePassrs']);
        $_SESSION['codePassrs'] = "";
    }
    ?>
</body>

</html>