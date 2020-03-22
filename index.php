<!DOCTYPE html>
    <html lang="de">
        <head>
            <title>Webchat</title> 
            <meta charset="utf-8">
            <link rel="stylesheet" href="style.css">
        </head>
    <body>
            <?php
                session_start();
                if(isset($_SESSION['username'])) {
                    header('location: chat.php');
                    exit();
                }
            ?>

            <h1> Webchat - Log in </h1>
            <div class="test">
                <form action="login.php" method="post"> 
                    Nutzername  : <input type="text" name="nutzer" autofocus><br><br>
                    Passwort    : <input type="password" name="passwort"><br><br>
                    <input  type="submit" value="Anmelden" name="login">
                </form>
            </div>
            <?php
                if (isset($_GET["code"]) && $_GET["code"] == 1) {
                    echo("<div id='error'>Melde dich bitte erstmal an!</div>");
                } else if (isset($_GET["code"]) && $_GET["code"] == 0) {
                    echo("<div id='error'>Falscher Benutzername oder Passwort</div>");
                } else if (isset($_GET["code"]) && $_GET["code"] == 4) {
                    echo("<div id='error'>Du musst erst deine Email bestätigen!</div>");
                } else if (isset($_GET["code"]) && $_GET["code"] == 5) {
                    echo("<div id='success'>Wenn alle Daten stimmen kannst du dich jetzt anmelden!</div>");
                }
            ?>

            <h1> Webchat - Registrieren </h1>
            <form action="register.php" method="post">
                Nutzername  : <input type="text" name="nutzer" autofocus><br><br>
                Email       : <input type="text" name="email"><br><br>
                Passwort    : <input type="password" name="passwort"><br><br>
                <input  type="submit" value="Registrieren" name="register">
            </form>
            <?php
                if (isset($_GET["code"]) && $_GET["code"] == 3) {
                    echo("<div id='success'>Du hast dich erfolgreich Registriert! <br>Du musst erst noch deine Email Bestätigen!</div>");
                } if (isset($_GET["code"]) && $_GET["code"] == 6) {
                    echo("<div id='error'>Ungültige Daten!</div>");
                }
            ?>

            <?php
                if (isset($_GET["code"]) && $_GET["code"] == 2) {
                    echo("<div id='success'>Du hast dich erfolgreich abgemeldet!</div>");
                }   
            ?>
    </body>
</html>