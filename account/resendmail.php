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
    if (isset($_SESSION['username'])) {
        header('location: ../chat/chat.php');
        exit();
    }
    ?>

    <h1 id="reghd"> Neue E-Mail anfordern </h1>
    <div class="feld">
        <form action="../components/mailrs.php" method="post">
            Email : <input type="text" name="email" autocomplete="off"><br><br>
            <input type="submit" value="Erneut senden!" name="resend">
            <a class="link" href="../index.php">Zurück zum Login!</a>
        </form>
    </div>
    <?php
    if (isset($_SESSION['codeResend']) && $_SESSION['codeResend'] != "") {
        echo ($_SESSION['codeResend']);
        $_SESSION['codeResend'] = "";
    }
    ?>
</body>

</html>