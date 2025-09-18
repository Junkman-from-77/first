<?php
    session_start();
    unset($_SESSION['valid_user']);
    header('location: index.php');
?>