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
        <form action="components/login.php" method="post">
            Nutzername :
            <?php
            echo ("<p class=unp>" . $_SESSION['username'] . "</p>");
            ?>
            E-Mail :
            <?php
            echo ("<p class=unp>" . $_SESSION['email'] . "</p>");
            ?>
            <a class="link" href="../index.php">Zurück zum Chat!</a>
        </form>  
    <img src="../components/getprofilepicture.php?profile=<?php echo $_SESSION['username']; ?>" id="pbpic"></img>
    <form action="../components/upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="datei"><br>
        <input type="submit" value="Hochladen">
    </form>
    <form action="../components/passch.php" method="post">
        Altes Passwort : <input type="password" name="oldpw" autocomplete="off"><br><br>
        Neues Passwort : <input type="password" name="newpw" autocomplete="off"><br><br>
        Neues Passwort bestätigen : <input type="password" name="newpwcn" autocomplete="off"><br><br>
        <input type="submit" value="Passwort ändern!" name="change">
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