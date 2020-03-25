<!DOCTYPE html>
    <html lang="de">
        <head>
            <title>Webchat</title> 
            <meta charset="utf-8">
            <link rel="stylesheet" href="style.css?v=1">
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
                    Nutzername  : <input type="text" name="nutzer" autofocus autocomplete="off"><br><br>
                    Passwort    : <input type="password" name="passwort" autocomplete="off"><br><br>
                    <input type="submit" value="Anmelden" name="login">
                </form>
            </div>

            <?php
                if (isset($_SESSION['codeAnmelden']) && $_SESSION['codeAnmelden'] != "") {
                    echo($_SESSION['codeAnmelden']);
                    $_SESSION['codeAnmelden'] = "";
                }
            ?>

            <h1 id="reghd"> Registrieren </h1>
            <div class="feld">
                <form action="account/register.php" method="post">
                    Nutzername              : <input type="text" name="nutzer" autofocus autocomplete="off"><br><br>
                    Email                   : <input type="text" name="email" autocomplete="off"><br><br>
                    Passwort                : <input type="password" name="passwort" autocomplete="off"><br><br>
                    Passwort wiederholen    : <input type="password" name="passwortwh" autocomplete="off"><br><br>
                    <input type="submit" value="Registrieren" name="register">
                </form>
            </div>
            <?php
                if (isset($_SESSION['codeRegister']) && $_SESSION['codeRegister'] != "") {
                    echo($_SESSION['codeRegister']);
                    $_SESSION['codeRegister'] = "";
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