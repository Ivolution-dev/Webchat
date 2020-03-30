<!DOCTYPE html>
<html lang="de">

<head>
    <title>Webchat</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="ressources/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
    <link rel="icon" type="image/png" href="ressources/logo.png">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['username'])) {
        header('location: chat/chat.php');
        exit();
    }

    ?>

    <h1 id="loghd"> Mein Profil </h1>
    <div class="feld">
        <form action="components/login.php" method="post">
            Nutzername oder Email : <input type="text" name="nutzer" autofocus autocomplete="off"><br><br>
            Passwort : <input type="password" name="passwort" autocomplete="off">
            <a class="link" href="account/forgetpassword.php">Passwort vergessen?</a><br><br>
            <input type="submit" value="Anmelden" name="login">
            <a class="link" href="account/create.php">Noch keinen Account? Hier klicken!</a>

        </form>
    </div>

    <?php
    if (isset($_SESSION['codeAnmelden']) && $_SESSION['codeAnmelden'] != "") {
        echo ($_SESSION['codeAnmelden']);
        $_SESSION['codeAnmelden'] = "";
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