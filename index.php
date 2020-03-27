<!DOCTYPE html>
<html lang="de">

<head>
    <title>Webchat</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="ressources/style.css?v=2">
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

    <h1 id="loghd"> Log in </h1>
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

    <script language="JavaScript">
        function disablediv(div) {
            var objDiv = document.getElementById(div);
            if (objDiv)
                objDiv.style.display = "none";
        }
        window.setTimeout("disablediv('error')", 2000);
        window.setTimeout("disablediv('success')", 2000);
    </script>
</body>

</html>