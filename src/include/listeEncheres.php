<?php  
    require_once(__ROOT__.'/src/class/Enchere.php');
    require_once(__ROOT__.'/src/class/Pagination.php');
    require_once(__ROOT__.'/src/controllers/encherirEnchere.php');
    require_once(__ROOT__.'/src/controllers/recupererData.php');
    require_once(__ROOT__.'/src/controllers/pagination.php');
?>
<?php 
    //Ici on gere l'action d'encherir
    if(isset($_POST['indice'])){
        encherir($_POST['indice']);
    }
    $allInactif = true; //Variable utilisée pour déterminer si toutes les cartes sont inactives
?>



<div id="articles" class="container-fluid mt-5">
    <h2 class="text-center mb-5 font-weight-bold">ARTICLES</h2>
    <div class=" d-flex justify-content-center flex-wrap">
        <!--On recupere les donnees dans le fichier data.json-->
        <?php $listing_enchere = recupererData();?>
        
        <!--Si le tableau a des données alors on peut afficher les cartes-->
        <?php if($listing_enchere !== null):?>

        <!--On récupère le nombre d'enchères pour déterminer la pagination-->
        <?php $nb_page = pagination($listing_enchere);$compteur =0;?>

        <?php
            //Gestion de la pagination
            //On récupère d'abord la page où l'on est
                if(isset($_GET['page'])){
                    $page_actuelle = $_GET['page'];
                }
                $pagination = new Pagination(
                    $listing_enchere,
                    3,
                    $_GET['page']
                );
                var_dump($pagination->intervalleMax());
                var_dump($pagination->intervalleMin());
        ?>

            <!--Pour chaque encheres dans data.json on va faire diffrentes traitements-->
            <?php foreach(array_reverse($listing_enchere) as $key => $items):?> 

                <!--Ici on gère là où on doit prendre les données selon la page actuelle-->
                <?php if($key + 1 > $pagination->intervalleMin() && $key + 1 <= $pagination->intervalleMax()):?>
                    
                    <!--Ici on ajoute ce qu'il y a dans data.json en object-->
                    <?php 
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
                        var_dump($key);
                        
                    ?>   
                    
                    <!--On verifie ici dès qu'il y a une carte active alors le allInactif passe à false-->
                    <?php if($listing_enchere->active_enchere == "Actif"){$allInactif = false;}?>
                    
                    <!--Ici on affiche uniquement les elements actifs-->
                    <?php if($listing_enchere->active_enchere == "Actif"):?>
                        <?php $pagination->nombreAfficheActuel();//Permet de compter le nombre d'éléments affichés?>
                        <?= $listing_enchere->toHTML();?>
                        <?= $listing_enchere->timerSCRIPT();?>
                    <?php endif; ?>

                <?php endif; ?>
                
            <?php endforeach; ?>

        <?php endif; ?>
        
        <!--Ici on affiche un message comme quoi il n'y a aucune enchere si tout est inactif ou tableau à 0-->
        <?php if(!$listing_enchere || $allInactif):?>
            <p>Aucun article disponible</p>
        <?php endif ?>
    </div>
    
    <!--Ici on affiche la pagination s'il y a des articles-->
    <?php if($listing_enchere || !$allInactif):?>
        <?= $pagination->toHTMLPrevious();?>
        <?php for($i = 1; $i < $pagination->nombrePages + 1; $i++):?>
            <?= $pagination->toHTMLPages($i);?>
        <?php endfor?>
        <?= $pagination->toHTMLNext();?>
    <?php endif;?>
</div>
        