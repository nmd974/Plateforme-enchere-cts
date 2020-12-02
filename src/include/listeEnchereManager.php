<?php 
    require_once(__ROOT__.'/src/controllers/etatEnchere.php');
    //Si on clique sur desactiver alors on lance la fonction desactiver qui va traiter l'action
    if(isset($_POST['desactiver'])){
        $desactivationEnchere = desactiverEnchere($_POST['id']);//On recupere dans une variable afin d'afficher le message retourné par la fonction
    };
    //Si on clique sur activer alors on lance la fonction activer qui va traiter l'action
    if(isset($_POST['activer'])){
        $activationEnchere = activerEnchere($_POST['id']);//On recupere dans une variable afin d'afficher le message retourné par la fonction
    };
?>
<div class="container-fluid mt-5">
    <h2 class="text-center mb-5 font-weight-bold">Liste des enchères</h2>
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
                <th scope="col" class="text-center">Image</th>
                <th scope="col" class="text-center">Intitule</th>
                <th scope="col" class="text-center">Durée de l'enchère</th>
                <th scope="col" class="text-center">Prix de base</th>
                <th scope="col" class="text-center">Prix du clic</th>
                <th scope="col" class="text-center">Augmentation durée</th>
                <th scope="col" class="text-center">Augmentation du prix</th>
                <th scope="col" class="text-center">Etat</th>
                <th scope="col" class="text-center">Actions</th>
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
                        <td class="text-center"><img src="<?php echo "../../img/". $listing_enchere->image_nom?>" alt="image enchere" class="img-thumbail" style="width:60px; height:60px; border: none;"></td>
                        <td class="text-center"><?= $listing_enchere->intitule ?></td>
                        <td class="text-center"><?= $listing_enchere->duree_enchere ?></td>
                        <td class="text-center"><?= $listing_enchere->prix_depart ?></td>
                        <td class="text-center"><?= $listing_enchere->prix_clic ?></td>
                        <td class="text-center"><?= $listing_enchere->augmentation_duree ?></td>
                        <td class="text-center"><?= $listing_enchere->augmentation_prix ?></td>
                        <td class="text-center"><?= $listing_enchere->active_enchere ?></td>
                        <td class="text-center">
                            <form method="post" action="enchereManager.php">
                                <input name="id" value="<?= $listing_enchere->id ?>" hidden>
                                <button type="submit" name="activer" class="btn btn-secondary" 
                                    <?php if($listing_enchere->active_enchere == "Actif"){ //Ici on desactive les boutons si l'enchere est active ou non si actif alors on en peut pas modifier et activer à nouveau
                                        echo 'disabled';
                                    }else{
                                        echo 'active';
                                    }
                                    ?>
                                >Activer
                                </button>
                                <button type="submit" name="desactiver" class="btn btn-secondary" 
                                    <?php if($listing_enchere->active_enchere == "Actif"){ //Ici on desactive les boutons si l'enchere est active ou non si actif alors on en peut pas modifier et activer à nouveau
                                        echo 'active';
                                    }else{
                                        echo 'disabled';
                                    }
                                    ?>
                                >Desactiver
                                </button>
                                <button type="submit" name="modifier" class="btn btn-secondary" 
                                    <?php if($listing_enchere->active_enchere == "Actif"){ //Ici on desactive les boutons si l'enchere est active ou non si actif alors on en peut pas modifier et activer à nouveau
                                        echo 'disabled';
                                    }else{
                                        echo 'active';
                                    }
                                    ?>
                                >Modifier
                                </button>
                            </form>
                        </td>
                    </tr>

                <?php endforeach?>
            <?php endif ?>
        </tbody>
    </table>
    </div>
    <?php if(!$listing_enchere):?>
        <p> Vous n'avez pas d'enchères enregistrées</p>
    <?php endif?>
</div>