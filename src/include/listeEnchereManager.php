<?php 
    require_once(__ROOT__.'/src/controllers/etatEnchere.php');
    require_once(__ROOT__.'/src/class/Enchere.php');
    //Si on clique sur desactiver alors on lance la fonction desactiver qui va traiter l'action
    if(isset($_GET['action'])){
        if($_GET['action'] == "desactiver" && $_GET['id'] !== ""){
            $desactivationEnchere = desactiverEnchere($_GET['id']);//On recupere dans une variable afin d'afficher le message retourné par la fonction
        };
    }
    //Si on clique sur activer alors on lance la fonction activer qui va traiter l'action
    if(isset($_GET['action'])){
        if($_GET['action'] == "activer" && $_GET['id'] !== ""){
            $activationEnchere = activerEnchere($_GET['id']);//On recupere dans une variable afin d'afficher le message retourné par la fonction
        };
    };  
?>
<div class="container-fluid mt-5">
    <h2 class="text-center align-middle mb-5 font-weight-bold">Liste des enchères</h2>
    <?php 
        global $desactivationEnchere;
        global $activationEnchere;
        if($desactivationEnchere){
            echo $desactivationEnchere;
        }
        if($activationEnchere){
            echo $activationEnchere;
        }
    ?>
    <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="text-center align-middle">Image</th>
                <th scope="col" class="text-center align-middle">Intitule</th>
                <th scope="col" class="text-center align-middle">Durée de l'enchère</th>
                <th scope="col" class="text-center align-middle">Prix de base</th>
                <th scope="col" class="text-center align-middle">Prix du clic</th>
                <th scope="col" class="text-center align-middle">Augmentation durée</th>
                <th scope="col" class="text-center align-middle">Augmentation du prix</th>
                <th scope="col" class="text-center align-middle">Etat</th>
                <th scope="col" class="text-center align-middle">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $listing_enchere = json_decode(file_get_contents(__ROOT__.'/src/data/data.json'), true); //On recupere les donnees dans le fichier data.json?>
            <?php if($listing_enchere):?>
                <?php foreach($listing_enchere as $key => $items): //Pour chaque encheres dans data.json on va faire diffrentes traitements?> 
                    <?php //Ici on ajoute ce qu'il y a dans data.json en object
                        $listing_enchere = new Enchere (
                            $items['id'],
                            $items['intitule'],
                            $items['prix_depart'],
                            $items['duree_enchere'],
                            $items['image_nom'],
                            $items['prix_clic'],
                            $items['augmentation_prix'],
                            $items['augmentation_duree'],
                            $items['date_fin'],
                            $items['active_enchere'],
                            $items['etat_enchere']
                        );
                    ?>  
                    <tr>
                        <td class="text-center align-middle"><img src="<?php echo "../../img/". $listing_enchere->image_nom?>" alt="image enchere" class="img-thumbail" style="width:120px; height:120px; border: none;"></td>
                        <td class="text-center align-middle"><?= htmlentities($listing_enchere->intitule,ENT_QUOTES) ?></td>
                        <td class="text-center align-middle"><?= htmlentities($listing_enchere->duree_enchere,ENT_QUOTES) ?></td>
                        <td class="text-center align-middle"><?= htmlentities($listing_enchere->prix_depart,ENT_QUOTES) ?></td>
                        <td class="text-center align-middle"><?= htmlentities($listing_enchere->prix_clic,ENT_QUOTES) ?></td>
                        <td class="text-center align-middle"><?= htmlentities($listing_enchere->augmentation_duree,ENT_QUOTES) ?></td>
                        <td class="text-center align-middle"><?= htmlentities($listing_enchere->augmentation_prix,ENT_QUOTES) ?></td>
                        <td class="text-center align-middle"><?= htmlentities($listing_enchere->active_enchere,ENT_QUOTES) ?></td>
                        <td class="text-center align-middle">
                        <!--LEs boutons d'actions-->
                            <a 
                                href="../pages/enchereManager.php?action=activer&id=<?= $listing_enchere->id ?>" 
                                class="btn btn-secondary btn-manager
                                <?php if($listing_enchere->active_enchere == "Actif"){ //Ici on desactive les boutons si l'enchere est active ou non si actif alors on en peut pas modifier et activer à nouveau
                                        echo 'disabled';
                                    }else{
                                        echo 'active';
                                    }
                                ?>"  
                                role="button" 
                                aria-pressed="true"
                            >Activer
                            </a>
                            <a 
                                href="../pages/enchereManager.php?action=desactiver&id=<?= $listing_enchere->id ?>" 
                                class="btn btn-secondary btn-manager
                                <?php if($listing_enchere->active_enchere == "Actif"){ //Ici on desactive les boutons si l'enchere est active ou non si actif alors on en peut pas modifier et activer à nouveau
                                        echo 'active';
                                    }else{
                                        echo 'disabled';
                                    }
                                ?>"  
                                role="button" 
                                aria-pressed="true"
                            >Desactiver
                            </a>     
                            <?php 
                            //Ici on defini les valeur a envoyer par l'url et on encode pour eviter le bug des espaces
                                $url =  "id=".htmlentities($listing_enchere->id, ENT_QUOTES).
                                        "&intitule=".urlencode(htmlentities($listing_enchere->intitule, ENT_QUOTES)).
                                        "&prix_depart=".htmlentities($listing_enchere->prix_depart, ENT_QUOTES).
                                        "&duree_enchere=".htmlentities($listing_enchere->duree_enchere, ENT_QUOTES).
                                        "&image_nom=".htmlentities($listing_enchere->image_nom, ENT_QUOTES).
                                        "&prix_clic=".htmlentities($listing_enchere->prix_clic, ENT_QUOTES).
                                        "&augmentation_prix=".htmlentities($listing_enchere->augmentation_prix, ENT_QUOTES).
                                        "&augmentation_duree=".htmlentities($listing_enchere->augmentation_duree, ENT_QUOTES);
                            ?>                       
                            <a 
                                href="../pages/modifierEnchere.php?<?php echo $url;?>" 
                                class="btn btn-secondary btn-manager
                                <?php if($listing_enchere->active_enchere == "Actif"){ //Ici on desactive les boutons si l'enchere est active ou non si actif alors on en peut pas modifier et activer à nouveau
                                        echo 'disabled';
                                    }else{
                                        echo 'active';
                                    }
                                ?>"  
                                role="button" 
                                aria-pressed="true"
                            >Modifier
                            </a>
                           
                        </td>
                    </tr>

                <?php endforeach?>
            <?php endif ?>
        </tbody>
    </table>
    </div>
    <?php if(!$listing_enchere):?>
        <p class="text-center align-middle mb-5 font-weight-bold"> Vous n'avez pas d'enchères enregistrées</p>
    <?php endif?>
</div>