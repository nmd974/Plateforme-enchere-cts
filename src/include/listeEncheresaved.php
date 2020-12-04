<?php  
    require_once(__ROOT__.'/src/class/Enchere.php');
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

<?php
//Gestion de la pagination
//On récupère d'abord la page où l'on est
    if(isset($_GET['page'])){
        $page_actuelle = $_GET['page'];
    }
    $maxPerPage = 8;

?>

<div id="articles" class="container-fluid mt-5">
    <h2 class="text-center mb-5 font-weight-bold">ARTICLES</h2>
    <div class=" d-flex justify-content-center flex-wrap">
        <!--On recupere les donnees dans le fichier data.json-->
        <?php $listing_enchere = recupererData();?>
        
        <!--Si le tableau a des données alors on peut afficher les cartes-->
        <?php if($listing_enchere !== null):?>

        <!--On récupère le nombre d'enchères pour déterminer la pagination-->
        <?php $nb_page = pagination($listing_enchere);?>

            <!--Pour chaque encheres dans data.json on va faire diffrentes traitements-->
            <?php foreach(array_reverse($listing_enchere) as $key => $items):?> 

                <!--Ici on gèere là où on doit prendre les données selon la page actuelle-->
                <?php if($key + 1 <= $page_actuelle*$maxPerPage && $key + 1 >= ($page_actuelle-1)*$maxPerPage):?>

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
                    ?>   
                    
                    <!--On verifie ici dès qu'il y a une carte active alors le allInactif passe à false-->
                    <?php if($listing_enchere->active_enchere == "Actif"){$allInactif = false;}?>
                    
                    <!--Ici on affiche uniquement les elements actifs-->
                    <?php if($listing_enchere->active_enchere == "Actif"):?>
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
        <div class=" d-flex justify-content-center flex-wrap">
            <nav aria-label="...">
                <ul class="pagination">
                <?php for($i=0;$i<$nb_page+1;$i++):?>
                    <?php if($i == 0):?>
                        <li class="page-item
                            <?php 
                                if($page_actuelle-1 == 0){
                                    echo 'disabled';
                                }
                            ?>
                        ">
                            <a class="page-link" href="../pages/home.php?page=<?= $page_actuelle - 1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                    <?php endif;?>
                    <?php if($i > 0 && $i !== $nb_page + 1):?>
                        <li class="page-item
                            <?php 
                                if($page_actuelle == $i){
                                    echo 'active';
                                }
                            ?>
                        ">
                            <a class="page-link" href="../pages/home.php?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endif;?>
                    <?php if($i == $nb_page):?>
                        <li class="page-item
                            <?php 
                                if($page_actuelle + 1 > $nb_page){
                                    echo 'disabled';
                                }
                            ?>
                        ">
                            <a class="page-link" href="../pages/home.php?page=<?= $page_actuelle + 1?>">Next</a>
                        </li>
                    <?php endif;?>
                <?php endfor; ?>
                </ul>
            </nav>
        </div>
    <?php endif;?>
</div>
        