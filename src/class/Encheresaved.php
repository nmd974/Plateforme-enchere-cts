<?php
 
class AjoutEnchere {
    
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

    public function saveToArray()
    {

        $enregistrementData = json_decode(file_get_contents(__ROOT__.'/src/data/data.json'), true); //On recupere le contenu de data.json
        if($enregistrementData){
            array_push($enregistrementData, $this);//On ajoute le nouvel id
            file_put_contents(__ROOT__.'/src/data/data.json', json_encode($enregistrementData));
        }else{
            $enregistrementData = [];
            array_push($enregistrementData, $this);//On ajoute le nouvel id
            file_put_contents(__ROOT__.'/src/data/data.json', json_encode($enregistrementData));
        }

    }

}
?>