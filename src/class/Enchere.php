<?php

class Enchere {
    
    public $intitule;
    public $prix_depart;
    public $duree_enchere;
    public $image_nom;
    public $prix_clic;
    public $augmentation_prix;
    public $augmentation_duree;
    public $date_fin;
    public $active_enchere;
    public $etat_enchere;

    public function __construct(string $id, string $intitule, float $prix_depart, int $duree_enchere, string $image_nom, float $prix_clic, float $augmentation_prix, int $augmentation_duree, int $date_fin, string $active_enchere, string $etat_enchere)
    {
        $this->id = $id;
        $this->intitule = $intitule;
        $this->prix_depart = $prix_depart;
        $this->duree_enchere = $duree_enchere;
        $this->image_nom = $image_nom;
        $this->prix_clic = $prix_clic;
        $this->augmentation_prix = $augmentation_prix;
        $this->augmentation_duree = $augmentation_duree;
        $this->date_fin = $date_fin;
        $this->active_enchere = $active_enchere;
        $this->etat_enchere = $etat_enchere;
    }

}
?>