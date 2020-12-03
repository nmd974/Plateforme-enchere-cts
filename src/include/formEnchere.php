<?php  
    require_once(__ROOT__.'/src/class/Enchere.php');
    require_once(__ROOT__.'/src/controllers/ajoutEnchere.php');
    if(isset($_POST['submit'])){ //Ici on va contrôler le contenu saisi et l'image
        $enchere = validationAjout($_POST, $_FILES);
    }
?>
        <div class="d-flex justify-content-center">
            <h2 class="mb-5 text-uppercase font-weight-bold">Ajout d'une enchère</h2>
        </div>
        <form class="container-fluid w-100 d-flex justify-content-center align-items-center flex-column" method="POST"
            enctype="multipart/form-data" action="ajouterEnchere.php">

            <?php 
            //Message d'erreur ou de confirmation selon la fonction
                global $enchere;
                    if($enchere){
                        echo $enchere;
                        
                        header('Location: ../pages/home.php');
                        sleep(5);
                    }
            ?>
            <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                <label class="labelForm" for="#intitule">Description :</label>
                <input type="text" class="form-control" id="intitule" maxlength="24" placeholder="24 caractères maximum"
                    name="intitule" required>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <label class="fileUpload d-flex justify-content-center align-items-center bg-light">
                    <input type="file" name="image_upload" id="image_upload" >
        
                </label>
            </div>
            <h3 class="mb-5 mt-4 d-flex justify-content-center text-center text-uppercase">Paramètres de l'enchère</h3>
            <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                <label class="labelForm" for="#prix_depart">Prix de lancement (€):</label>
                <input type="number" class="form-control" aria-label="Prix de lancement" placeholder="En euros"
                    name="prix_depart" id="prix_depart" min="0.01" value="1.00" step="0.01" required aria-describedby="basic-addon1">
            </div>
            <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                <label class="labelForm" for="#duree_enchere">Durée (h):</label>
                <input type="number" class="form-control" aria-label="duree_enchere" placeholder="En heures" id="duree_enchere" name="duree_enchere"
                    min="1" value="48" required aria-describedby="basic-addon1">
            </div>
            <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                <label class="labelForm" for="#prix_clic">Prix du clic (cts):</label>
                <input type="number" class="form-control" placeholder="En centimes" aria-label="prix_clic" name="prix_clic"
                    id="prix_clic" value="0.50" required aria-describedby="basic-addon1" max="0.99" min="0.01" step="0.01">
            </div>
            <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                <label class="labelForm" for="#augmentation_prix">Augmentation du prix (cts):</label>
                <input type="number" class="form-control" aria-label="augmentation_prix" placeholder="En centimes"
                    name="augmentation_prix" value="0.01" required id="augmentation_prix" aria-describedby="basic-addon1"
                    max="0.99" min="0.01" step="0.01">
            </div>
            <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                <label class="labelForm" for="#augmentation_duree">Augmentation durée (s):</label>
                <input type="number" class="form-control" aria-label="augmentation_duree" placeholder="En secondes"
                    name="augmentation_duree" value="30" required id="augmentation_duree" min="0"
                    aria-describedby="basic-addon1">
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" name="submit"
                    class="btn btn-warning text-uppercase text-white font-weight-bold btnAjoutEnchere mb-5"
                    style="width:220px;">Ajouter l'enchère</button>
            </div>
        </form>
        
