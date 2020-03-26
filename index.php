<!DOCTYPE html>
    <html lang="de">
        <head>
            <title>Webchat</title> 
            <meta charset="utf-8">
            <link rel="stylesheet" href="style.css?v=1">
            <link rel="icon" type="image/png" href="logo.png">
        </head>
    <body>
            <?php
                session_start();
                if (isset($_SESSION['username'])) {
                    header('location: chat/chat.php');
                    exit();
                }
                
            ?>

            <h1 id="loghd"> Log in </h1>
            <div class="feld">
                <form action="account/login.php" method="post"> 
                    Nutzername oder Email  : <input type="text" name="nutzer" autofocus autocomplete="off"><br><br>
                    Passwort    : <input type="password" name="passwort" autocomplete="off"><br><br>
                    <input type="submit" value="Anmelden" name="login">
                    <a href="account/create.php">Noch keinen Account? Hier registrieren!</a>
                </form>
            </div>

            <?php
                if (isset($_SESSION['codeAnmelden']) && $_SESSION['codeAnmelden'] != "") {
                    echo($_SESSION['codeAnmelden']);
                    $_SESSION['codeAnmelden'] = "";
                }
            ?>

            <?php
                if (isset($_SESSION['codeAbmelden']) && $_SESSION['codeAbmelden'] != "") {
                    echo($_SESSION['codeAbmelden']);
                    $_SESSION['codeAbmelden'] = "";
                }
            ?>
    </body>
</html>