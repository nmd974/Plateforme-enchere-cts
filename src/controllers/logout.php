<?php 
session_start();
    unset($_SESSION['id']);
    unset($_SESSION['role']);
    unset($_SESSION['solde']);
    unset($_SESSION['adminLogged']);
    unset($_SESSION['userLogged']);
    header('Location: ../pages/home.php?page=1');
?>