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

    <?php
    if (isset($_SESSION['codeUpload']) && $_SESSION['codeUpload'] != "") {
        echo ($_SESSION['codeUpload']);
        $_SESSION['codeUpload'] = "";
    }
    ?>

    <h1 id="loghd"> Mein Profil </h1>
    <div class="feld">

        <label for="name">Nutzername : <?php echo $_SESSION['username']; ?></label>
        <img src="../components/getprofilepicture.php?profile=<?php echo $_SESSION['username']; ?>" id="pbpic"></img>
        <form action="../components/upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="datei">
            <input type="submit" value="Hochladen">
            <label for="name"> E-Mail : <?php echo  $_SESSION['email'] ?></label>
        </form>
        <form action="../components/passch.php" method="post">
<<<<<<< HEAD
            <label for="oldpw">Altes Passwort : <input type="password" name="oldpw" autocomplete="off"></label><br>
            Neues Passwort : <input type="password" name="newpw" autocomplete="off"><br>
            Neues Passwort bestätigen : <input type="password" name="newpwcn" autocomplete="off"><br><br>
=======
            <label for="name">Altes Passwort : <input type="password" name="oldpw" autocomplete="off"></label>
            Neues Passwort : <input type="password" name="newpw" autocomplete="off">
            Neues Passwort bestätigen : <input type="password" name="newpwcn" autocomplete="off">
>>>>>>> a5b6c6db94b791a063ae15da84dcc72d1920e1b0
            <input type="submit" value="Passwort ändern!" name="change">
            <a class="link" href="../index.php">Zurück zum Chat!</a>
        </form>
    </div>
    <?php
    if (isset($_SESSION['codeChangePassword']) && $_SESSION['codeChangePassword'] != "") {
        echo ($_SESSION['codeChangePassword']);
        $_SESSION['codeChangePassword'] = "";
    }
    ?>
</body>

</html>