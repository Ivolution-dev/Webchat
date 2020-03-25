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
                    header('location: chat.php');
                    exit();
                }
                
            ?>

            <h1 id="loghd"> Log in </h1>
            <div class="feld">
                <form action="login.php" method="post"> 
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
                /*
                if (isset($_GET["code"]) && $_GET["code"] == 1) {
                    echo("<div id='error'>Melde dich bitte erstmal an!</div>");
                } else if (isset($_GET["code"]) && $_GET["code"] == 0) {
                    echo("<div id='error'>Falscher Benutzername oder Passwort</div>");
                } else if (isset($_GET["code"]) && $_GET["code"] == 4) {
                    echo("<div id='error'>Du musst erst deine Email bestätigen!</div>");
                } else if (isset($_GET["code"]) && $_GET["code"] == 5) {
                    echo("<div id='success'>Wenn alle Daten stimmen kannst du dich jetzt anmelden!</div>");
                }
                */
            ?>

            <h1 id="reghd"> Registrieren </h1>
            <div class="feld">
                <form action="register.php" method="post">
                    Nutzername  : <input type="text" name="nutzer" autofocus autocomplete="off"><br><br>
                    Email       : <input type="text" name="email" autocomplete="off"><br><br>
                    Passwort    : <input type="password" name="passwort" autocomplete="off"><br><br>
                    <input type="submit" value="Registrieren" name="register">
                </form>
            </div>
            <?php
                if (isset($_SESSION['codeRegister']) && $_SESSION['codeRegister'] != "") {
                    echo($_SESSION['codeRegister']);
                    $_SESSION['codeRegister'] = "";
                }
                /*
                if (isset($_GET["code"]) && $_GET["code"] == 3) {
                    echo("<div id='success'>Du hast dich erfolgreich Registriert! <br>Du musst erst noch deine Email Bestätigen!</div>");
                } else if (isset($_GET["code"]) && $_GET["code"] == 6) {
                    echo("<div id='error'>Ungültige Daten!</div>");
                } else if (isset($_GET["code"]) && $_GET["code"] == 7) {
                    echo("<div id='error'>Der Benutzername ist zu lang! <br>Der Name darf nicht länger als 8 Zeichen sein!</div>");
                } else if (isset($_GET["code"]) && $_GET["code"] == 8) {
                    echo("<div id='error'>Der Benutzer existiert bereits oder diese Email wurde bereits verwendet!</div>");
                }
                */
            ?>

            <?php
                if (isset($_GET["code"]) && $_GET["code"] == 2) {
                    echo("<div id='success'>Du hast dich erfolgreich abgemeldet!</div>");
                }   
            ?>
    </body>
</html>