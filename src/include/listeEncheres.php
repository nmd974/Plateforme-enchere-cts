<?php  
    require_once(__ROOT__.'/src/class/Enchere.php');
    require_once(__ROOT__.'/src/controllers/encherirEnchere.php');
?>
<?php 
    //Ici on gere l'ajout du prix à augmenter
    if(isset($_POST['indice'])){
        encherir($_POST['indice']);
    }
    $allInactif = true;
?>

<div id="articles" class="container-fluid mt-5">
    <h2 class="text-center mb-5 font-weight-bold">ARTICLES</h2>
    <div class=" d-flex justify-content-center flex-wrap">
        <?php $listing_enchere = json_decode(file_get_contents(__ROOT__.'/src/data/data.json'), true); //On recupere les donnees dans le fichier data.json?>
        <?php if($listing_enchere):?>
        <?php foreach(array_reverse($listing_enchere) as $key => $items): //Pour chaque encheres dans data.json on va faire diffrentes traitements?> 
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
            <?php 
                if($listing_enchere->active_enchere == "Actif"){
                    $allInactif = false;
                }
            ?>
            <?php if($listing_enchere->active_enchere == "Actif"): //Ici on affiche uniquement les elements actifs?>
                <div class="card  shadow m-lg-4" style="width: 18rem;">
                    <div class="duree d-flex position-absolute w-50 justify-content-center align-items-center font-weight-bold"
                        id="<?= htmlentities($listing_enchere->id)?>"></div>
                        <?php if(htmlentities($listing_enchere->image_nom,ENT_QUOTES) !== ""):?>
                            <img src="<?php echo "../../img/" . htmlentities($listing_enchere->image_nom,ENT_QUOTES); ?>"
                                class="card-img-top img-fluid" style="height:230px;" alt="...">
                        <?php endif ?>
                        <?php if(htmlentities($listing_enchere->image_nom,ENT_QUOTES) == ""):?>
                        <div class="d-flex justify-content-center align-items-center" style="height:230px;">
                            <i class="fa fa-file-image-o fa-5x" aria-hidden="true"></i>
                        </div>
                        <?php endif ?>
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"><?= htmlentities($listing_enchere->intitule,ENT_QUOTES) ?></h5>
                        <h4 class="display-6 font-weight-bold"><?= round($listing_enchere->prix_depart, 2) ?> €</h4>
                        <p class="card-text m-0">Prix du clic : <?= htmlentities($listing_enchere->prix_clic,ENT_QUOTES) ?> cts</p>
                        <p class="card-text mb-4">Prix de l'enchère : <?= htmlentities($listing_enchere->augmentation_prix,ENT_QUOTES) ?>
                            cts/clic</p>
                        <div class="text-center">
                            <form method="POST" action="#<?= $listing_enchere->id?>">
                                <input name="indice" value="<?= $listing_enchere->id?>" style="display:none;">
                                <button class="btn btn-primary btn-listEnchere p-0" name="submit">Enchérir</button>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    var timer = setInterval(function countDown() {
                        var tempAct = new Date();
                        var heure = Math.floor(tempAct.getTime() / 1000);
                        var timeRemaining = <?php echo $listing_enchere->date_fin;?> - heure;
                        var hoursRemaining = parseInt(timeRemaining / 3600); // conversion en heures
                        var minutesRemaining = parseInt((timeRemaining % 3600) / 60); // conversion en minutes
                        var secondsRemaining = parseInt((timeRemaining % 3600) % 60); // conversion en secondes
                        document.getElementById('<?= $listing_enchere->id ?>').innerHTML = hoursRemaining + ' h : ' + minutesRemaining + ' m : ' + secondsRemaining + ' s ';
                        if (timeRemaining <= 0) {
                            document.getElementById('<?= $listing_enchere->id;?>').innerHTML = "EXPIRE";
                        }
                    }, 1000); // répéte la fonction toutes les 1 seconde
                </script>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php if(!$listing_enchere || $allInactif):?>
            <p>Aucun article disponible</p>
        <?php endif ?>
    </div>
</div>