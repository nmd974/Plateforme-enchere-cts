<?php 
    unset($_SESSION['id']);
    unset($_SESSION['role']);
    unset($_SESSION['solde']);

    header('Location: ../pages/home.php?page=1');
?>