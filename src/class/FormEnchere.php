<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Enchere.php';

$listing_enchere = [];

class FormulaireEnchere {
    
    public $intitule;
    public $prix_depart;
    public $duree_enchere;
    public $image_nom;
    public $prix_clic;
    public $augmentation_prix;
    public $augmentation_duree;

    public function __construct(string $intitule, int $prix_depart, int $duree_enchere, string $image_nom, float $prix_clic, float $augmentation_prix, int $augmentation_duree)
    {
        $this->id = md5(uniqid(rand(), true));
        $this->intitule = $intitule;
        $this->prix_depart = $prix_depart;
        $this->duree_enchere = $duree_enchere;
        $this->image_nom = $image_nom;
        $this->augmentation_prix = $augmentation_prix;
        $this->augmentation_duree = $augmentation_duree;
        $this->saveToArray();
    }

    public function encherir()
    {

    }

    public function gestionactivation()
    {

    }
    
    public function saveToArray()
    {
        global $listing_enchere;
        array_push($listing_enchere, $this);
        
    }

}
?>