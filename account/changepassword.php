<!DOCTYPE html>
<html lang="de">

<head>
    <title>Webchat</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../ressources/style.css?v=6">
    <link rel="icon" type="image/png" href="../ressources/logo.png">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        session_start();
        $_SESSION['codeAnmelden'] = "<div id='error'>Melde dich bitte erstmal an!</div>";
        header('location: ../index.php');
        exit();
    }
    ?>
    
    <h1 id="reghd"> Passwort ändern </h1>
    <?php
    echo ("<p class=unchpw>Du bist eingeloggt als: " . $_SESSION['username'] . "</p>");
    ?>
    <div class="feld">
        <form action="../components/passch.php" method="post">
            Altes Passwort : <input type="password" name="oldpw" autocomplete="off"><br><br>
            Neues Passwort : <input type="password" name="newpw" autocomplete="off"><br><br>
            Neues Passwort bestätigen : <input type="password" name="newpwcn" autocomplete="off"><br><br>
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