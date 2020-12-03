<?php 
    define('__ROOT__', dirname(dirname(__DIR__))); 
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
            <a class="navbar-brand js-scroll-trigger text-white font-weight-bold" href="#page-top" id="title-header">Ventes aux enchères</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">

                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger text-white effect-underline font-weight-bold" href="../pages/home.php?page=1">Liste des enchères</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link js-scroll-trigger text-white effect-underline font-weight-bold dropdown-toggle" href="../pages/enchereManager.php?page=1" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Enchère Manager
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../pages/enchereManager.php">Liste des enchères</a>
                            <a class="dropdown-item" href="../pages/ajouterEnchere.php">Ajouter un produit</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>