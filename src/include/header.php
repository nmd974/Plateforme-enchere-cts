<?php 
    define('__ROOT__', dirname(dirname(__DIR__))); 
    require_once(__ROOT__.'/src/controllers/authentification.php');
    require_once(__ROOT__.'/src/controllers/recupererData.php');
    
    //On lance la session
    session_start();

    if(!isset($_SESSION['adminLogged'])){
        $_SESSION['adminLogged'] = false;
    }
    if(!isset($_SESSION['userLogged'])){
        $_SESSION['userLogged'] = false;
    }
    var_dump($_SESSION);


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleListeEnchere.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <script src="https://use.fontawesome.com/c18e5332f2.js"></script>

    <title>
        <?php if($title){
            echo $title;
        }else{
            echo "Plateforme d'enchère";
        }?>
    </title>
</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark sticky-top mb-5" id="mainNav">
        <div class="container-fluid">
            <a class="navbar-brand js-scroll-trigger text-white font-weight-bold" href="../pages/home.php?page=1" id="title-header"><i class="fa fa-cube fa-2x" aria-hidden="true"></i></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger text-white effect-underline font-weight-bold" href="../pages/home.php?page=1">Liste des enchères</a>
                    </li>
                    <!--Ici on gere l'affichage du bouton de gestion de l'admins s'il est connecte-->
                    <?php if($_SESSION['adminLogged']):?>
                        <li class="nav-item dropdown">
                            <a class="nav-link js-scroll-trigger text-white effect-underline font-weight-bold dropdown-toggle" href="../pages/enchereManager.php?page=1" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Enchère Manager
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="../pages/enchereManager.php">Liste des enchères</a>
                                <a class="dropdown-item" href="../pages/ajouterEnchere.php">Ajouter un produit</a>
                            </div>
                        </li>
                    <?php endif?>
                </ul>
                <!--Ici on gere l'affichage du bouton se connecter si personne est connecte-->
                <?php if(!$_SESSION['adminLogged'] && !$_SESSION['userLogged']):?> 
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex">
                            <span class="text-dark effect-underline font-weight-bold">Non connecté</pspan>
                        </div>
                        <div>
                            <a href="../pages/auth.php" class="text-white effect-underline font-weight-bold">
                            <button class="btn btn-manager">Se connecter <i class="fa fa-sign-out" aria-hidden="true"></i></button></a>
                        </div>
                        
                    </div>
                <?php endif ?>
                <?php if($_SESSION['userLogged']):?> 
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex">
                            <span class="text-dark effect-underline font-weight-bold">Votre solde :</pspan>
                            <span class="text-dark effect-underline font-weight-bold text-center ml-2"><?= $_SESSION['solde'] ?> €</span>
                        </div>
                        <div>
                            <a href="../controllers/logout.php" class="text-white effect-underline font-weight-bold">
                            <button class="btn btn-manager">Se déconnecter <i class="fa fa-sign-in" aria-hidden="true"></i></button></a>
                        </div>
                        
                    </div>
                <?php endif ?>
                <?php if($_SESSION['adminLogged']):?> 
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex">
                            <span class="text-dark effect-underline font-weight-bold">Mode admin active</pspan>
                        </div>
                        <div>
                            <a href="../controllers/logout.php" class="text-white effect-underline font-weight-bold">
                            <button class="btn btn-manager">Se déconnecter <i class="fa fa-sign-in" aria-hidden="true"></i></button></a>
                        </div>
                        
                    </div>
                <?php endif ?>
            </div>
        </div>
    </nav>
</header>