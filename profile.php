<?php session_start();
    if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
        echo 'Welcome, ' . $_SESSION['username'] . '!!!';
?>
        <a href="logout.php">Log out</a>
    <?php
    } else {
        header('location: inloggen.php');
    }
?>
