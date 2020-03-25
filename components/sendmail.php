<?php
    session_start();
    $empfaenger = $_SESSION['empfaenger'];
    $betreff = $_SESSION['betreff'];
    $mail = $_SESSION['mail'];
    $backTo = $_SESSION['backTo'];

    mail($empfaenger, $betreff, $mail);

    header("location: $backTo");
    exit();
?>