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
    if (!isset($_SESSION['username'])) {
        header('location: ../index.php');
        exit();
    }
    ?>

    <h1 id="loghd"> Mein Profil </h1>
    <div class="feld">
        <form action="components/login.php" method="post">
            Nutzername : 
            <?php
                echo ("<p class=unp>". $_SESSION['username'] . "</p>");
            ?>
            E-Mail :
            <?php
                echo ("<p class=unp>". $_SESSION['email'] . "</p>");
            ?>
            <a class="link" href="account/changepassword.php">Passwort ändern</a><br><br>

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