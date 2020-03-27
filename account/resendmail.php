<!DOCTYPE html>
    <html lang="de">
        <head>
            <title>Webchat</title> 
            <meta charset="utf-8">
            <link rel="stylesheet" href="../style.css?v=1">
            <link rel="icon" type="image/png" href="../logo.png">
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
                    Email                   : <input type="text" name="email" autocomplete="off"><br><br>
                    <input type="submit" value="Erneut senden!" name="resend">
                    <a class="link" href="../index.php">Zurück zur Registrierung!</a>
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