<?php
// define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/src/class/Enchere.php');
require_once(__ROOT__.'/src/data/data.json');

    $obj = new Enchere (
        "Samsung 10",
        1,
        48,
        "image1.jpg",
        0.50,
        0.30,
        30
    );
    $obj = new Enchere (
        "Iphone X",
        1,
        48,
        "image1.jpg",
        0.50,
        0.30,
        30
    );
  


?>

<?php 
//Ici on gere l'ajout du prix à augmenter
var_dump($_GET['id']);
    // if(isset($_GET['id'])){
    //     var_dump($_GET['id']);
    //     $id = $_GET['id'];
    //     foreach($listing_enchere as $key => $items){
    //         if($items->id == $id){
    //             $items->encherir();
    //         }
    //     }
    // }
?>
<div id="articles" class="container-fluid mt-5">
    <h2 class="text-center mb-5 font-weight-bold">ARTICLES</h2>
    <div class=" d-flex justify-content-center flex-wrap">

        <!--Boucle pour chaque items dans le tableau dans la variable session-->
        <?php 
            $listing_enchere = json_decode(file_get_contents(__ROOT__.'/src/data/data.json'), true);            
        ?>
        <?php if($listing_enchere):?>
        <?php foreach($listing_enchere as $key => $items) :?>
        <?php if($items['active_enchere'] == "Actif"):?>
        <div class="card  shadow m-lg-4" style="width: 18rem;">
            <div class="duree d-flex position-absolute w-50 justify-content-center align-items-center font-weight-bold"
                id="<?= $items['id']?>"></div>
            <img src="<?php echo "img/" . htmlentities($items['image_nom'],ENT_QUOTES); ?>"
                class="card-img-top img-fluid" style="height:230px;" alt="...">
            <div class="card-body">
                <h5 class="card-title font-weight-bold"><?= htmlentities($items['intitule'],ENT_QUOTES) ?></h5>
                <h4 class="display-6 font-weight-bold"><?= htmlentities($items['prix_depart'],ENT_QUOTES) ?> €</h4>
                <p class="card-text m-0">Prix du clic : <?= htmlentities($items['prix_clic'],ENT_QUOTES) ?> cts</p>
                <p class="card-text mb-4">Prix de l'enchère : <?= htmlentities($items['augmentation_prix'],ENT_QUOTES) ?>
                    cts/clic</p>
                <div class="text-center">
                    <a href="<?php echo __ROOT__.'/index.php?id=' . htmlentities($items['id'],ENT_QUOTES)?>" class="btn btn-primary btn-listEnchere p-0" name="submit">Enchérir</a>
                </div>
            </div>
        </div>

        <script>
            var timer = setInterval(function countDown() {
                var tempAct = new Date();
                var heure = Math.floor(tempAct.getTime() / 1000);
                var timeRemaining = <?php echo $items['prix_clic'];?> - heure;
                var hoursRemaining = parseInt(timeRemaining / 3600); // conversion en heures
                var minutesRemaining = parseInt((timeRemaining % 3600) / 60); // conversion en minutes
                var secondsRemaining = parseInt((timeRemaining % 3600) % 60); // conversion en secondes
                document.getElementById('<?= $items->id ?>').innerHTML = hoursRemaining + ' h : ' + minutesRemaining + ' m : ' + secondsRemaining + ' s ';
                if (timeRemaining <= 0) {
                    document.getElementById('<?= $items['prix_clic'];?>').innerHTML = "EXPIRE";
                }
            }, 1000); // répéte la fonction toutes les 1 seconde
        </script>

        <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
        <p>Aucun article disponible</p>
    </div>
</div>