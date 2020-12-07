<?php  
    require_once(__ROOT__.'/src/controllers/authentification.php');
    if(isset($_POST['submit'])){ //Ici on va contrôler le mot de passe saisi
        $auth = validationConnexion($_POST);
        if($auth[0] && $auth[1] == "admin"){
            $_SESSION['adminLogged'] = true;
            header('Location: ../pages/home.php?page=1');
        };
        if($auth[0] && $auth[1] == "user"){
            $_SESSION['userLogged'] = true;
            header('Location: ../pages/home.php?page=1');
        }
    }

?>
        <div class="d-flex justify-content-center align-items-center mb-5">
            <h2 class="text-uppercase font-weight-bold">Se connecter</h2>
            <div class="custom-control custom-switch ml-5">
                <input type="checkbox" class="custom-control-input active" id="customSwitch1">
                <label class="custom-control-label" for="customSwitch1">Compte existant</label>
            </div>
        </div>

        <form class="container-fluid w-100 d-flex justify-content-center align-items-center flex-column" method="POST"
            enctype="multipart/form-data" action="<?php htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)?>">
            <?php 
            if(isset($_POST['submit'])){
                echo $auth[2];
            }
        ?>
            <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                <label class="labelForm" for="#username">Pseudo :</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Pseudo" required> 
            </div>

            <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                <label class="labelForm" for="#password">Mot de passe :</label>
                <input type="password" class="form-control" placeholder="Mot de passe" name="password" id="password" required>
            </div>
            
            <div class="d-flex justify-content-center align-items-center mt-4">
                <button type="submit" name="submit"
                    class="btn btn-warning text-uppercase text-white font-weight-bold btnAjoutEnchere mb-5"
                    style="width:220px;">Se connecter</button>
            </div>
        </form>
        
