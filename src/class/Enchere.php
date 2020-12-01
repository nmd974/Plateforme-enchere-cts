<?php

$listing_enchere_class = [];

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

    public function __construct(string $id, string $intitule, int $prix_depart, int $duree_enchere, string $image_nom, float $prix_clic, float $augmentation_prix, int $augmentation_duree, int $date_fin, string $active_enchere, string $etat_enchere)
    {
        $this->id = $id;
        $this->intitule = $intitule;
        $this->prix_depart = $prix_depart;
        $this->duree_enchere = $duree_enchere;
        $this->image_nom = $image_nom;
        $this->augmentation_prix = $augmentation_prix;
        $this->augmentation_duree = $augmentation_duree;
        $this->date_fin = $date_fin;
        $this->active_enchere = $active_enchere;
        $this->etat_enchere = $etat_enchere;
        $this->saveToArray();
    }

    public function encherir($id)
    {
        $this->prix_depart = $this->prix_depart + $this->augmentation_prix;
        var_dump($id);
    }

    public function gestionactivation()
    {

    }
    
    public function saveToArray()
    {
        global $listing_enchere_class;

        return array_push($listing_enchere_class, array($this));

        // $enregistrementData = json_decode(file_get_contents(__ROOT__.'/src/data/data.json'), true); //On recupere le contenu de data.json
        // if($enregistrementData){
        //     array_push($enregistrementData, $this);//On ajoute le nouvel id
        //     file_put_contents(__ROOT__.'/src/data/data.json', json_encode($enregistrementData));
        // }else{
        //     $enregistrementData = [];
        //     array_push($enregistrementData, $this);//On ajoute le nouvel id
        //     file_put_contents(__ROOT__.'/src/data/data.json', json_encode($enregistrementData));
        // }

    }

}
?>