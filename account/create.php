<!DOCTYPE html>
<html lang="de">

<head>
    <title>Webchat</title>
    <meta charset="utf-8">
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

    <h1 id="reghd"> Registrieren </h1>
    <div class="feld">
        <form action="../components/register.php" method="post">
            Nutzername : <input type="text" name="nutzer" autofocus autocomplete="off"><br><br>
            Email : <input type="text" name="email" autocomplete="off"><br><br>
            Passwort : <input type="password" name="passwort" autocomplete="off"><br><br>
            Passwort wiederholen : <input type="password" name="passwortwh" autocomplete="off"><br><br>
            <input type="submit" value="Registrieren" name="register">
            <a class="link" href="../index.php">Zurück zur Anmeldung!</a>
            <a class="link" href="resendmail.php">Keine E-Mail erhalten? Hier klicken!</a>
        </form>
    </div>
    <?php
    if (isset($_SESSION['codeRegister']) && $_SESSION['codeRegister'] != "") {
        echo ($_SESSION['codeRegister']);
        $_SESSION['codeRegister'] = "";
    }
    ?>

    <?php
    if (isset($_SESSION['codeAbmelden']) && $_SESSION['codeAbmelden'] != "") {
        echo ($_SESSION['codeAbmelden']);
        $_SESSION['codeAbmelden'] = "";
    }
    ?>
</body>

</html>