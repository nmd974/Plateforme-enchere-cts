<?php

//Parametrer sa pagination
//Il faut déterminer la page actuelle par $_GET['page'] par exemple puis créer une instance de la classe pagination
// $pagination = new Pagination(
//     $listing_enchere, (le tableau où il y a les données)
//     3, (nombre de resultat par page que l'on souhaite)
//     $_GET['page']
// );

//On recupere le nombre de page total
//<?php $nb_page = pagination($listing_enchere);$compteur =0; et on declare une variable compteur

//Pour savoir quelles cartes afficher il faut créer une condition
//if($key + 1 > $pagination->intervalleMin() && $key + 1 <= $pagination->intervalleMax())

//A chaque affichage de carte on incrémente le compteur
//<?php $pagination->nombreAfficheActuel();

/*Puis on affiche le resultat final s'il y a de quoi afficher 
 <?= $pagination->toHTMLPrevious();?>
    <?php for($i = 1; $i < $pagination->nombrePages + 1; $i++):?>
        <?= $pagination->toHTMLPages($i);?>
    <?php endfor?>
<?= $pagination->toHTMLNext();?>*/

class Pagination {
    
    public $itemsPerPage;
    public $items;
    public $itemsTotal;
    public $pageActuelle;
    public $nombrePages;
    public $compteurSurPage = 0;
    public $listePages = [];
    private $classActive = "page-item active";
    private $classDisabled = "page-item disabled";
    private $classNormale = "page-item";

    public function __construct(array $items, int $itemsPerPage, int $pageActuelle)
    {
        $this->items = $items;
        $this->itemsPerPage = $itemsPerPage;
        $this->pageActuelle = $pageActuelle;
        $this->nombrePages = $this->calculNombrePages();
    }

    public function calculNombrePages():int
    {
        if(!$this->items){
            return null;//Si rien à afficher alors on retourne null
        }else{
            //Si un traitement doit être effectue 
            $itemsFilter = array_filter($this->items, function($select){
                return $select['active_enchere'] =='Actif';//Ici on détermine ce sur quoi on veut trier le tableau
            });
            $this->itemsTotal = count(!$itemsFilter ? $this->items : $itemsFilter); //On détermine la valeur de la quantite totale de resultat
            return ceil(count(!$itemsFilter ? $this->items : $itemsFilter)/$this->itemsPerPage);//Sinon on retourne l'arrondi au supérieur du nombre de pages
        }
         
    }

    public function nombreAfficheActuel()
    {
        //Ici on a besoin de déterminer à combien sont affichés sur la page
        return $this->compteurSurPage++;
    }

    public function intervalleMin ()
    {
        //Il faut que la $key+1 (car debut à 0) soit supérieure à la page actuelle - 1 * le nombre par page
        //Par exemple, on est à la page 2 et on veut afficher uniquement 10 alors on affiche les elements 10 à 20 
        return ($this->pageActuelle - 1)*$this->itemsPerPage;
    }
    
    public function intervalleMax ()
    {
        //Il faut que la $key+1 (car debut à 0) soit inférieure ou égale à la page actuelle * le nombre par page
        return $this->pageActuelle * $this->itemsPerPage;
    }

    public function toHTMLPrevious():string
    {
        //On détermine la classe ici pour mettre disabled ou active
        if($this->pageActuelle - 1 == 0){
            $class = $this->classDisabled;
        }else{
            $class = $this->classNormale;
        }

        //On détermine la valeur du lien lors du clic
        $lien = $this->pageActuelle - 1;

        return <<<HTML
            <div class=" d-flex justify-content-center flex-wrap">
            <nav>
                <ul class="pagination">
                    <li class="{$class}">
                        <a class="page-link" href="../pages/home.php?page={$lien}" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
HTML;
    }

    public function toHTMLPages($i)
    {
            
            //On détermine la classe
            if($this->pageActuelle == $i){
                $class = $this->classActive;
            }else{
                $class = $this->classNormale;
            }
            return <<<HTML
            <li class="{$class}">
                <a class="page-link" href="../pages/home.php?page={$i}">{$i}</a>
            </li>
HTML;
        
    }

    public function toHTMLNext():string
    {
        //On détermine la classe ici pour mettre disabled ou active
        if($this->pageActuelle + 1 > $this->nombrePages){
            $class = $this->classDisabled;
        }else{
            $class = $this->classNormale;
        }

        //On détermine la valeur du lien lors du clic
        $lien = $this->pageActuelle + 1;

        return <<<HTML
                    <li class="{$class}">
                        <a class="page-link" href="../pages/home.php?page={$lien}" tabindex="-1" aria-disabled="true">Next</a>
                    </li>
                </ul>
                <p class="text-center">{$this->compteurSurPage}/ {$this->itemsTotal}</p>
            </nav>
        </div>
HTML;
    }

    public function toHTMLGlobal()
    {
        //A revoir pour que l'on puisse avoir toutes les valeurs de page 
        //J'ai essayé avec un retour de tableau mais je n'ai pas pu faire afficher chaque valeur
        //Cette fonction ne renvoie qu'une seule page
        $previous = $this->toHTMLPrevious();
        $pages = $this->toHTMLPages();
        $next = $this->toHTMLNext();
        return <<<HTML
            {$previous}
            {$pages}
            {$next}
HTML;
    }

}

?>