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
    <link rel="stylesheet" href="./src/css/styleListeEnchere.css">
    <link rel="stylesheet" href="./src/css/navbar.css">

    <title>Plateforme d'enchères</title>
</head>

<body>
    <!--HEADER-->
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
                            <a class="nav-link js-scroll-trigger text-white effect-underline font-weight-bold" href="index.php">Liste des enchères</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger text-white font-weight-bold" href="./src/pages/enchereManager.php" id="encherenav">Enchère manager</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <?php
        define('__ROOT__', __DIR__);  
        require_once(__ROOT__.'/src/include/listeEncheressaved.php');
    ?>  


    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
</body>

</html>