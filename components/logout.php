<?php
    session_start();
    session_destroy();
    session_start();
    $_SESSION['codeAbmelden'] = "<div id='success'>Du hast dich erfolgreich abgemeldet!</div>";
    header('location: ../index.php');
    exit();
?>