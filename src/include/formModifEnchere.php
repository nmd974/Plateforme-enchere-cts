<?php  
    require_once(__ROOT__.'/src/class/Enchere.php');
    require_once(__ROOT__.'/src/controllers/modificationEnchere.php');
    if(isset($_POST['submit'])){ //Ici on va contrôler le contenu saisi et l'image
        $enchere = modificationEnchere($_GET, $_FILES, $_GET['image_nom']);
    }
?>
        <div class="d-flex justify-content-center">
            <h2 class="mb-5 text-uppercase font-weight-bold">Modification d'une enchère</h2>
        </div>
        <?php if(isset($_GET['id'])):?>
            <form class="container-fluid w-100 d-flex justify-content-center align-items-center flex-column" method="POST"
                enctype="multipart/form-data" action="modifierEnchere.php">

                <?php 
                //Message d'erreur ou de confirmation selon la fonction
                    global $enchere;
                        if($enchere){
                            echo $enchere;
                            header('Location: ../pages/home.php');
                        }
                ?>
                <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                    <label class="labelForm" for="#intitule">Description :</label>
                    <input type="text" class="form-control" id="intitule" maxlength="24" placeholder="24 caractères maximum"
                        name="intitule" value=<?=$_GET['intitule']?> required>
                </div>
                <img src="<?php echo "../../img/" . $_GET['image_nom']?>" width="200px" height="200px" class="mb-3"
                            alt="image enchere">
                        <div class="d-flex justify-content-center align-items-center">
                            <label class="fileUpload d-flex justify-content-center align-items-center bg-light">
                                Modifier l'image
                                <input type="file" name="image_upload" style="display:none;" id="image_upload">
                            </label>
                        </div>
                <h3 class="mb-5 mt-4 d-flex justify-content-center text-center text-uppercase">Paramètres de l'enchère</h3>
                <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                    <label class="labelForm" for="#prix_depart">Prix de lancement (€):</label>
                    <input type="number" class="form-control" aria-label="Prix de lancement" placeholder="En euros"
                        name="prix_depart" id="prix_depart" min="0.01" value=<?=$_GET['prix_depart']?> step="0.01" required aria-describedby="basic-addon1">
                </div>
                <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                    <label class="labelForm" for="#duree_enchere">Durée (h):</label>
                    <input type="number" class="form-control" aria-label="duree_enchere" placeholder="En heures" id="duree_enchere" name="duree_enchere"
                        min="1" value=<?=$_GET['duree_enchere']?> required aria-describedby="basic-addon1">
                </div>
                <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                    <label class="labelForm" for="#prix_clic">Prix du clic (cts):</label>
                    <input type="number" class="form-control" placeholder="En centimes" aria-label="prix_clic" name="prix_clic"
                        id="prix_clic" value=<?=$_GET['prix_clic']?> required aria-describedby="basic-addon1" max="0.99" min="0.01" step="0.01">
                </div>
                <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                    <label class="labelForm" for="#augmentation_prix">Augmentation du prix (cts):</label>
                    <input type="number" class="form-control" aria-label="augmentation_prix" placeholder="En centimes"
                        name="augmentation_prix" value=<?=$_GET['augmentation_prix']?> required id="augmentation_prix" aria-describedby="basic-addon1"
                        max="0.99" min="0.01" step="0.01">
                </div>
                <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
                    <label class="labelForm" for="#augmentation_duree">Augmentation durée (s):</label>
                    <input type="number" class="form-control" aria-label="augmentation_duree" placeholder="En secondes"
                        name="augmentation_duree" value=<?=$_GET['augmentation_duree']?> required id="augmentation_duree" min="0"
                        aria-describedby="basic-addon1">
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" name="submit"
                        class="btn btn-warning text-uppercase text-white font-weight-bold btnAjoutEnchere mb-5"
                        style="width:220px;">Enregistrer les modifications</button>
                </div>
            </form>
        <?php endif ?>
        
