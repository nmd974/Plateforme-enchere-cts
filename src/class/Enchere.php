<?php
 
class Enchere {
    
    public $id;
    public $intitule;
    public $prix_depart;
    public $duree_enchere;
    public $image_nom;
    public $prix_clic;
    public $augmentation_prix;
    public $augmentation_duree;
    public $date_fin = null;
    public $active_enchere = 'Actif';
    public $etat_enchere = 'Disponible';

    public $listing_enchere = [];

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
        $this->prix_depart = $this->prix_depart + $this->augmentation_prix;
        $this->saveToArray();
    }

    public function gestionactivation()
    {

    }
    
    public function saveToArray()
    {
        $enregistrementData = file_get_contents(__ROOT__.'/src/data/data.json', true); //On recupere le contenu de data.json
        // var_dump(json_decode($enregistrementData));
        global $listing_enchere;
        
        array_push($listing_enchere, $this);//On ajoute le nouvel id
        array_push($listing_enchere, $enregistrementData);//On ajoute les dernieres données
        echo json_decode (file_get_contents(__ROOT__.'/src/data/data.json'), true);
        file_put_contents(__ROOT__.'/src/data/data.json', json_encode($listing_enchere));
        // $enregistrementData = file_get_contents('../data/data.json', true)
    }

}
?>